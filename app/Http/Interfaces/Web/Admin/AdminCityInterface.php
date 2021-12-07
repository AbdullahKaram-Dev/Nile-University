<?php
declare(strict_types=1);

namespace App\Http\Interfaces\Web\Admin;

use App\DataTables\CityDataTable;
use Illuminate\Http\JsonResponse;

interface AdminCityInterface
{
    public function index(CityDataTable $cityDataTable):object;

    public function create():object;

    public function store($request):JsonResponse;

    public function edit($id):object;

    public function update($updateCity):JsonResponse;

    public function destroy($city):object;
}
