<?php
declare(strict_types=1);

namespace App\Http\Repositories\Web\Admin;

use App\Models\Sector;
use Illuminate\Http\JsonResponse;
use App\DataTables\SectorDataTable;
use App\Http\Traits\Web\Admin\GlobalResponse;
use App\Http\Interfaces\Web\Admin\AdminSectorInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AdminSectorRepository implements AdminSectorInterface
{

    use GlobalResponse;
    private Sector $SectorModel;

    public function __construct(Sector $SectorModel)
    {
        $this->SectorModel = $SectorModel;
    }

    public function index(SectorDataTable $sectorDataTable): object
    {
        return $sectorDataTable->render('admin.sector.index');
    }

    public function create(): object
    {
         return view('admin.sector.create');
    }

     public function store($request): JsonResponse
     {
         try {
             $this->SectorModel->create($request->validated());
             return $this->responseJson('success',200);
         } catch (\RuntimeException $exception) {
             return response()->json('error',500);
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
             return $this->responseJson('success',200);
         } catch (\RuntimeException $exception) {
             return $this->responseJson('error',500);
         }
     }

     public function destroy($sector): object
     {
        try {
            $this->SectorModel->findOrFail($sector)->delete();
            return redirect(route('sectors.index'))->with(['success' => __('dashboard.sector_deleted_successfully_')]);
        } catch (ModelNotFoundException $modelNotFoundException) {
            return redirect(route('sectors.index'))->with(['error' => __('dashboard.sector_not_founded')]);
        }
     }

}
