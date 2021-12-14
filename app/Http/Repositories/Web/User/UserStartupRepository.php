<?php
declare(strict_types=1);

namespace App\Http\Repositories\Web\User;

use App\Http\Traits\Web\Admin\GlobalResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Interfaces\Web\User\UserStartupInterface;
use App\Http\Traits\Web\Startup\StartUpTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Models\FrontSector;
use App\Models\FrontCity;
use App\Models\Startup;

class UserStartupRepository implements UserStartupInterface
{
    use StartUpTrait,GlobalResponse;

    public Startup $startupModel;

    public function __construct(Startup $startupModel)
    {
        $this->startupModel = $startupModel;
    }


    public function showStartupInfo()
    {
        return view('user.startup.view', ['startup' => $this->startupModel
                ->with(['user:id,name,email', 'city:id,city_name', 'sectors'])
                ->where('user_id', auth()->user()->id)->first()->toArray()]);
    }

    public function edit()
    {
        $cities = FrontCity::select('id','city_name')->get()->toArray();
        $sectors = FrontSector::select('id','sector_name')->get()->toArray();
        $startup_id = $this->startupModel
                      ->where('user_id',auth()->user()->id)
                      ->first()->value('id');
        try {
            return view('user.startup.edit', ['startup' => $this->startupModel
                ->with(['user:id,name,email','city:id'])->findOrFail($startup_id)->toArray(),
                'cities' => $cities,
                'all_sectors' => $sectors,
                'startup_sectors' => DB::table('sector_startup')->whereIn('startup_id',[$startup_id])
                    ->pluck('sector_id')->toArray(),
            ]);
        } catch (ModelNotFoundException $modelNotFoundException) {
            return redirect(route('user.show.startup'))->with(['error' => __('dashboard.startup_not_founded')]);
        }
    }

    public function updateStartup($request): JsonResponse
    {
        try {
            $requestData = $request->only(['startup_logo','startup_name','city_id']);
            if ($request->has('startup_logo'))
                $requestData['startup_logo'] = $this->uploadStartUpAvatar($request->startup_logo);

            $startup = $this->startupModel->find($request->startup_id);
            $startup->update($requestData);
            $startup->sectors()->sync($request->sector_ids);
            return $this->responseJson('success', 200);
        } catch (\RuntimeException $exception) {
            return $this->responseJson('error', 200);
        }
    }
}
