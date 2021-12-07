<?php
declare(strict_types=1);

namespace App\Http\Controllers\Web\Admin;

use App\Http\Interfaces\Web\Admin\AdminCityInterface;
use App\Http\Requests\Web\Admin\UpdateCityRequest;
use App\Http\Requests\Web\Admin\StoreCityRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\DataTables\CityDataTable;

class AdminCityController extends Controller
{
    private AdminCityInterface $AdminCityInterface;

    public function __construct(AdminCityInterface $AdminCityInterface)
    {
        $this->AdminCityInterface = $AdminCityInterface;
    }

    public function index():object
    {
        return $this->AdminCityInterface->index(new CityDataTable());
    }

    public function create():object
    {
        return $this->AdminCityInterface->create();
    }

    public function store(StoreCityRequest $storeCityRequest):JsonResponse
    {
        return $this->AdminCityInterface->store($storeCityRequest);
    }

    public function edit($id): object
    {
        return $this->AdminCityInterface->edit($id);
    }

    public function update(UpdateCityRequest $updateCityRequest):JsonResponse
    {
        return $this->AdminCityInterface->update($updateCityRequest);
    }

    public function destroy($city): object
    {
        return $this->AdminCityInterface->destroy($city);
    }
}
