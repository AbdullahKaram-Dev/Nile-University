<?php
declare(strict_types=1);

namespace App\Http\Repositories\Web\Admin;

use App\Http\Interfaces\Web\Admin\AdminStartupInterface;
use App\Models\City;
use App\Models\Deal;
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
                ->editColumn('status',function ($startups){
                    return $this->statusStartup($startups);
                })
                ->editColumn('deal_status',function ($startups){
                    return $this->statusDeal($startups);
                })
                ->addIndexColumn()
                ->addColumn('action', function ($startups) {
                    return $this->dropDownStartupControl($startups->id);
                })
                ->rawColumns(['action','startup_logo','created_at','status','deal_status'])
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
                  <a class="dropdown-item" href="' . route('startups.edit', ['startup' => $startup]) . '">' . __('dashboard.edit_startup') . '</a>
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

    protected function statusStartup($startup)
    {
        $status = ($startup->status === 1) ? 'active' : 'blocked';
        $class = ($status === "active") ? 'success' : 'danger';
        return "<a onclick='changeStartupStatus($startup->id,$startup->status)' class='text-white badge badge-".$class."'>
                ".$status."</a>";
    }

    protected function statusDeal($startup)
    {
        $status = ($startup->deal_status === 1) ? 'active' : 'blocked';
        $class = ($status === "active") ? 'success' : 'danger';
        return
            "<a onclick='changeStartupDealStatus($startup->id,$startup->deal_status)' class='text-white badge badge-".$class."'>
            ".$status."</a>";
    }

    public function changeStartupStatus($request)
    {
        try {
            $newStatus = ($request->startup_current_status == 1) ? 0 : 1;
            $this->startUpModel->find($request->startup_id)->update(['status' => $newStatus]);
            return $this->responseJson('success', 200);
        } catch (\RuntimeException $exception) {
            return $this->responseJson('error', 200);
        }
    }

    public function changeStartupDealStatus($request)
    {
        try {
            $dealStatus = ($request->deal_current_status == 1) ? 0 : 1;
            $dealStatusSingle = ($dealStatus == 0) ? 2 : 1;
            Deal::where('startup_id',$request->startup_id)->update(['status' => $dealStatusSingle]);
            $this->startUpModel->find($request->startup_id)->update(['deal_status' => $dealStatus]);
            return $this->responseJson('success', 200);
        } catch (\RuntimeException $exception) {
            return $this->responseJson('error', 200);
        }
    }

    public function edit($startup_id)
    {
        $cities = FrontCity::select('id','city_name')->get()->toArray();
        $sectors = FrontSector::select('id','sector_name')->get()->toArray();
        try {
            return view('admin.startup.edit', ['startup' => $this->startUpModel
                ->with(['user:id,name,email','city:id'])->findOrFail($startup_id)->toArray(),
               'cities' => $cities,
               'all_sectors' => $sectors,
               'startup_sectors' => DB::table('sector_startup')->whereIn('startup_id',[$startup_id])
                                    ->pluck('sector_id')->toArray(),
            ]);
        } catch (ModelNotFoundException $modelNotFoundException) {
            return redirect(route('startups.index'))->with(['error' => __('dashboard.startup_not_founded')]);
        }
    }

    public function updateStartup($request)
    {
        try {
            $requestData = $request->only(['startup_logo','startup_name','city_id']);
            if ($request->has('startup_logo'))
                $requestData['startup_logo'] = $this->uploadStartUpAvatar($request->startup_logo);

            $stratup = $this->startUpModel->find($request->startup_id);
            $stratup->update($requestData);
            $stratup->sectors()->sync($request->sector_ids);
            return $this->responseJson('success', 200);
        } catch (\RuntimeException $exception) {
            return $this->responseJson('error', 200);
        }
    }
}
