<?php
declare(strict_types=1);

namespace App\Http\Repositories\Web\Admin;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Interfaces\Web\Admin\AdminSectorInterface;
use App\Http\Traits\Web\Admin\GlobalResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\Sector;

class AdminSectorRepository implements AdminSectorInterface
{

    use GlobalResponse;

    private Sector $SectorModel;

    public function __construct(Sector $SectorModel)
    {
        $this->SectorModel = $SectorModel;
    }

    public function index()
    {
        if (request()->ajax()) {
            $sectors = $this->SectorModel->select(['id', 'sector_name',
                DB::raw("JSON_VALUE(sectors.sector_name, '$.en') AS sector_name_en"),
                DB::raw("JSON_VALUE(sectors.sector_name, '$.ar') AS sector_name_ar"),
            ]);
            return datatables()->eloquent($sectors)
                ->addIndexColumn()
                ->addColumn('action', function ($sector) {
                    return $this->dropDownControlUser($sector->id);
                })
                ->filterColumn("sector_name_en", function ($query, $keyword) {
                    $sql = "JSON_VALUE(sectors.sector_name, '$.en')  like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
                ->filterColumn("sector_name_ar", function ($query, $keyword) {
                    $sql = "JSON_VALUE(sectors.sector_name, '$.ar')  like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.sector.index');
    }

    public function create(): object
    {
        return view('admin.sector.create');
    }

    public function store($request): JsonResponse
    {
        try {
            $this->SectorModel->create($request->validated());
            return $this->responseJson('success', 200);
        } catch (\RuntimeException $exception) {
            return response()->json('error', 500);
        }
    }

    public function edit($id): object
    {
        try {
            return view('admin.sector.edit', ['sector' => $this->SectorModel->findOrFail($id)->toArray()]);
        } catch (ModelNotFoundException $modelNotFoundException) {
            return redirect(route('sectors.index'))->with(['error' => __('dashboard.sector_not_founded')]);
        }
    }

    public function update($sectorUpdateRequest): JsonResponse
    {
        try {
            $this->SectorModel->find($sectorUpdateRequest->sector_id)
                ->update($sectorUpdateRequest->validated());
            return $this->responseJson('success', 200);
        } catch (\RuntimeException $exception) {
            return $this->responseJson('error', 500);
        }
    }

    public function destroy($sector): object
    {
        try {
            $this->SectorModel->findOrFail($sector)->delete();
            return redirect(route('sectors.index'))->with(['success' => __('dashboard.sector_deleted_successfully')]);
        } catch (ModelNotFoundException $modelNotFoundException) {
            return redirect(route('sectors.index'))->with(['error' => __('dashboard.sector_not_founded')]);
        }
    }

    protected function dropDownControlUser($sector)
    {
        return '<div class="btn-group">
                <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">' . __("dashboard.open") . '</button>
                <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuReference1">
                  <a class="dropdown-item" href="' . route('sectors.edit', ['sector' => $sector]) . '">' . __('dashboard.edit_sector') . '</a>
                  <a class="dropdown-item" href="' . route('sector.destroy', ['sector' => $sector]) . '">' . __('dashboard.delete_sector') . '</a>
                </div>
               </div>';
    }

}
