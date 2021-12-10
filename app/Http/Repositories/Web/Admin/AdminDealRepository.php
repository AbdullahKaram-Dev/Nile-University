<?php
declare(strict_types=1);

namespace App\Http\Repositories\Web\Admin;

use App\Http\Interfaces\Web\Admin\AdminDealInterface;
use App\Http\Traits\Web\Admin\GlobalResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\Deal;

class AdminDealRepository implements AdminDealInterface
{
    use GlobalResponse;

    public Deal $dealModel;
    public static array $DEAL_STATUS = [
        'pending'  => 0,
        'approved' => 1,
        'rejected' => 2
    ];

    public function __construct(Deal $dealModel)
    {
        $this->dealModel = $dealModel;
    }

    public function startupDeals($startupID): JsonResponse
    {
        if (request()->ajax()) {
            $deals = $this->dealModel->select(['status','id', 'deal_name', 'deal_description', 'deal_value', 'deal_logo', 'created_at',
                DB::raw("JSON_VALUE(deals.deal_name, '$.en') AS deal_name_en"),
                DB::raw("JSON_VALUE(deals.deal_name, '$.ar') AS deal_name_ar"),
                DB::raw("JSON_VALUE(deals.deal_description, '$.en') AS deal_description_en"),
                DB::raw("JSON_VALUE(deals.deal_description, '$.ar') AS deal_description_ar"),
            ])->where('startup_id', $startupID);

            return datatables()->eloquent($deals)
                ->addIndexColumn()
                ->editColumn('deal_logo', function ($deals) {
                    return $this->getLogoDeal($deals->deal_logo);
                })
                ->editColumn('status', function ($deals) {
                    $selectOption = '';
                    foreach(self::$DEAL_STATUS as $statusName => $statusValue){
                        $selectedStatus = ($statusValue == $deals->status) ? 'selected' : '';
                        $selectOption .= '<option value="'.$deals->id.'" '.$selectedStatus.'>'.$statusName.'</option>';
                    }
                    return '<select class="border-0" onchange="changeDealStatus(this)">'.$selectOption.'</select>';
                })
                ->editColumn('created_at', function ($deals) {
                    return $deals->created_at->diffForHumans();
                })
                ->addColumn('action', function ($deals) {
                    return $this->dropDownDealsControl($deals->id);
                })
                ->filterColumn("deal_name_en", function($query, $keyword) {
                    $sql = "JSON_VALUE(deals.deal_name, '$.en')  like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
                ->filterColumn("deal_name_ar", function($query, $keyword) {
                    $sql = "JSON_VALUE(deals.deal_name, '$.ar')  like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
                ->filterColumn("deal_description_en", function($query, $keyword) {
                    $sql = "JSON_VALUE(deals.deal_description, '$.en')  like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
                ->filterColumn("deal_description_ar", function($query, $keyword) {
                    $sql = "JSON_VALUE(deals.deal_description, '$.ar')  like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
                ->rawColumns(['action', 'deal_logo', 'created_at','status'])
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
                  <a class="dropdown-item" href="' . route('startups.show', ['startup' => $deal]) . '">' . __('dashboard.show_startup_and_deals') . '</a>
                </div>
               </div>';
    }

    private function getLogoDeal($deal_logo): string
    {
        return '<img src="' . asset('/storage/deal-avatar/' . $deal_logo) . '" class="img-fluid" alt="avatar">';
    }

    public function changeDealStatus($request):JsonResponse
    {
        try {
            $this->dealModel->find($request->deal_id)->update(['status' => self::$DEAL_STATUS[$request->status]]);
            return $this->responseJson('success',200);
        }catch (\Exception $exception){
            return $this->responseJson('error',200);
        }
    }
}
