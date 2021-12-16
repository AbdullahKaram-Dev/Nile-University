<?php
declare(strict_types=1);

namespace App\Http\Repositories\Web\User;

use \App\Http\Interfaces\Web\User\UserDealStartupInterface;
use App\Http\Traits\Web\Admin\GlobalResponse;
use App\Http\Traits\Web\Deal\DealTrait;
use App\Models\Startup;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\Deal;

class UserDealStartupRepository implements UserDealStartupInterface
{
    use GlobalResponse, DealTrait;

    public Deal $dealModel;
    public static array $DEAL_STATUS = [0 => 'pending', 1 => 'approved', 2 => 'rejected'];

    public function __construct(Deal $dealModel)
    {
        $this->dealModel = $dealModel;
    }

    public function getDealStartup($startup_id): JsonResponse
    {
        if (request()->ajax()) {
            $deals = $this->dealModel->select(['status', 'id', 'deal_name', 'deal_description', 'deal_value', 'deal_logo', 'created_at',
                DB::raw("JSON_VALUE(deals.deal_name, '$.en') AS deal_name_en"),
                DB::raw("JSON_VALUE(deals.deal_name, '$.ar') AS deal_name_ar"),
                DB::raw("JSON_VALUE(deals.deal_description, '$.en') AS deal_description_en"),
                DB::raw("JSON_VALUE(deals.deal_description, '$.ar') AS deal_description_ar"),
            ])->where('startup_id', $startup_id);

            return datatables()->eloquent($deals)
                ->addIndexColumn()
                ->editColumn('deal_logo', function ($deals) {
                    return $this->getLogoDeal($deals->deal_logo);
                })
                ->editColumn('status', function ($deals) {
                    return '<span class="btn btn-info">' . self::$DEAL_STATUS[$deals->status] . '</span>';
                })
                ->editColumn('created_at', function ($deals) {
                    return $deals->created_at->diffForHumans();
                })
                ->addColumn('action', function ($deals) {
                    return $this->dropDownDealsControl($deals->id);
                })
                ->filterColumn("deal_name_en", function ($query, $keyword) {
                    $sql = "JSON_VALUE(deals.deal_name, '$.en')  like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
                ->filterColumn("deal_name_ar", function ($query, $keyword) {
                    $sql = "JSON_VALUE(deals.deal_name, '$.ar')  like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
                ->filterColumn("deal_description_en", function ($query, $keyword) {
                    $sql = "JSON_VALUE(deals.deal_description, '$.en')  like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
                ->filterColumn("deal_description_ar", function ($query, $keyword) {
                    $sql = "JSON_VALUE(deals.deal_description, '$.ar')  like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
                ->rawColumns(['action', 'deal_logo', 'created_at', 'status'])
                ->make(true);
        }
    }

    private function dropDownDealsControl($deal): string
    {
        return '<div class="btn-group">
                <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">' . __("dashboard.open") . '</button>
                <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuReference1">
                  <a class="dropdown-item"  href=' . route('user.edit.deal', $deal) . '>' . __('dashboard.edit_deal') . '</a>
                  <a class="dropdown-item"  onclick="deleteDeal(' . $deal . ')">' . __('dashboard.delete_deal') . '</a>
                </div>
               </div>';
    }

    private function getLogoDeal($deal_logo): string
    {
        return '<img src="' . asset('/storage/deal-avatar/' . $deal_logo) . '" class="img-fluid" alt="avatar">';
    }

    public function destroyDeal($request): JsonResponse
    {
        try {
            $this->dealModel->find($request->deal_id)->delete();
            return $this->responseJson('success', 200);
        } catch (\Exception $exception) {
            return $this->responseJson('error', 200);
        }
    }

    public function editDeal($deal_id)
    {
        try {
            return view('user.deal.edit', ['deal' =>
                $this->dealModel->findOrFail($deal_id)->toArray()]);
        } catch (ModelNotFoundException $modelNotFoundException) {
            return redirect(route('user.show.startup'))->with(['error' => __('dashboard.deal_not_founded')]);
        }
    }

    public function updateDeal($request): JsonResponse
    {
        try {
            $requestData = $request->only(['deal_name', 'deal_description', 'deal_value', 'deal_logo']);
            if ($request->has('deal_logo'))
                $requestData['deal_logo'] = $this->uploadDealLogo($request->deal_logo);

            $this->dealModel->find($request->deal_id)->update($requestData);
            return $this->responseJson('success', 200);
        } catch (\RuntimeException $exception) {
            return $this->responseJson('error', 200);
        }
    }

    public function createDeal()
    {
        return view('user.deal.create');
    }

    public function storeDeal($request): JsonResponse
    {
        try {
            $requestData = $request->only(['deal_name', 'deal_description', 'deal_value', 'deal_logo']);
            $requestData['deal_logo'] = $this->uploadDealLogo($request->deal_logo);
            $requestData['startup_id'] = Startup::select('id')->where('user_id',auth()->user()->id)
                                         ->first()->id;
            $this->dealModel->create($requestData);
            return $this->responseJson('success', 200);
        } catch (\RuntimeException $exception) {
            return $this->responseJson('error', 200);
        }
    }
}
