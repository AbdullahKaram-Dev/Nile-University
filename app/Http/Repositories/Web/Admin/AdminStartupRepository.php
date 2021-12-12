<?php
declare(strict_types=1);

namespace App\Http\Repositories\Web\Admin;

use App\Http\Interfaces\Web\Admin\AdminStartupInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Traits\Web\Startup\StartUpTrait;
use App\Http\Traits\Web\Admin\GlobalResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\FrontSector;
use App\Models\FrontCity;
use App\Models\Startup;
use App\Models\User;

class AdminStartupRepository implements AdminStartupInterface
{
    use GlobalResponse,StartUpTrait;

    private Startup $startUpModel;

    public function __construct(Startup $startUpModel)
    {
        $this->startUpModel = $startUpModel;
    }

    public function index()
    {
        if (request()->ajax())
        {
            $startups = $this->startUpModel->with(['user:id,name,email','city:id,city_name']);
            return datatables()->eloquent($startups)
                ->editColumn('startup_logo',function ($startups){
                    return $this->getLogoStartUp($startups->startup_logo);
                })
                ->editColumn('created_at',function ($startups){
                    return $startups->created_at->diffForHumans();
                })
                ->addIndexColumn()
                ->addColumn('action', function ($startups) {
                    return $this->dropDownStartupControl($startups->id);
                })
                ->rawColumns(['action','startup_logo','created_at'])
                ->make(true);
        }
        return view('admin.startup.index');
    }

    private function getLogoStartUp($startup_logo):string
    {
        return '<img src="'.asset('/storage/startup-avatar/'.$startup_logo).'" class="img-fluid" alt="avatar">';
    }

    private function dropDownStartupControl($startup):string
    {
        return '<div class="btn-group">
                <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">' . __("dashboard.open") . '</button>
                <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuReference1">
                  <a class="dropdown-item" href="' . route('startups.show', ['startup' => $startup]) . '">' . __('dashboard.show_startup_and_deals') . '</a>
                </div>
               </div>';
    }

    public function showStartupInfo($startupID)
    {
        try {
            return view('admin.startup.view', ['startup' => $this->startUpModel
                     ->with(['user:id,name,email','city:id,city_name','sectors'])->findOrFail($startupID)->toArray()]);
        } catch (ModelNotFoundException $modelNotFoundException) {
            return redirect(route('startups.index'))->with(['error' => __('dashboard.startup_not_founded')]);
        }
    }

    public function create()
    {
        return view('admin.startup.create',[
            'sectors' => FrontSector::select(['id','sector_name'])->get()->toArray(),
            'cities' => FrontCity::select(['id','city_name'])->get()->toArray()
        ]);
    }

    public function createUserStartup($request)
    {
        try {
            DB::beginTransaction();
            $user = User::create([
               'name' => $request->name,
               'email' => $request->name,
               'password' => Hash::make($request->password)
            ]);
            $startUp = Startup::create([
               'startup_name' => $request->startup_name,
                'user_id' => $user->id,
                'city_id' => $request->city_id,
                'startup_logo' => $this->uploadStartUpAvatar($request->startup_logo)
            ]);
            $startUp->sectors()->syncWithoutDetaching($request->input('sector_ids'));
            DB::commit();
            return $this->responseJson('success',200);
        }catch (\Exception $exception){
            DB::rollBack();
            return $this->responseJson('error',200);
        }
    }

}
