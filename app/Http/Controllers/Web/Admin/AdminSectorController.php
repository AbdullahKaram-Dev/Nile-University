<?php
declare(strict_types=1);

namespace App\Http\Controllers\Web\Admin;

use App\Http\Interfaces\Web\Admin\AdminSectorInterface;
use App\Http\Requests\Web\Admin\UpdateSectorRequest;
use App\Http\Requests\Web\Admin\StoreSectorRequest;
use App\Http\Controllers\Controller;
use App\DataTables\SectorDataTable;
use Illuminate\Http\JsonResponse;

class AdminSectorController extends Controller
{
    private AdminSectorInterface $AdminSectorInterface;

    public function __construct(AdminSectorInterface $AdminSectorInterface)
    {
        $this->AdminSectorInterface = $AdminSectorInterface;
    }

    public function index():object
    {
        return $this->AdminSectorInterface->index(new SectorDataTable());
    }

    public function create():object
    {
        return $this->AdminSectorInterface->create();
    }

    public function store(StoreSectorRequest $storeSectorRequest):JsonResponse
    {
        return $this->AdminSectorInterface->store($storeSectorRequest);
    }

    public function edit($id):object
    {
        return $this->AdminSectorInterface->edit($id);
    }

    public function update(UpdateSectorRequest $updateSectorRequest):JsonResponse
    {
        return $this->AdminSectorInterface->update($updateSectorRequest);
    }

    public function destroy($sector):object
    {
        return $this->AdminSectorInterface->destroy($sector);
    }
}
