<?php
declare(strict_types=1);

namespace App\Http\Repositories\Web\Admin;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Interfaces\Web\Admin\AdminCityInterface;
use App\Http\Traits\Web\Admin\GlobalResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\City;

class AdminCityRepository implements AdminCityInterface
{

    use GlobalResponse;

    private City $CityModel;

    public function __construct(City $CityModel)
    {
        $this->CityModel = $CityModel;
    }

    public function index()
    {
        if (request()->ajax()) {

            $cities = $this->CityModel->select(['id', 'city_name',
                DB::raw("JSON_VALUE(cities.city_name, '$.en') AS city_name_en"),
                DB::raw("JSON_VALUE(cities.city_name, '$.ar') AS city_name_ar"),
            ]);
            return datatables()->eloquent($cities)
                ->addIndexColumn()
                ->addColumn('action', function ($city) {
                    return $this->dropDownControlUser($city->id);
                })
                ->filterColumn("city_name_en", function ($query, $keyword) {
                    $sql = "JSON_VALUE(cities.city_name, '$.en')  like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
                ->filterColumn("city_name_ar", function ($query, $keyword) {
                    $sql = "JSON_VALUE(cities.city_name, '$.ar')  like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
                ->rawColumns(['action'])
                ->make(true);

        }

        return view('admin.city.index');
    }

    public function create(): object
    {
        return view('admin.city.create');
    }

    public function store($request): JsonResponse
    {
        try {
            $this->CityModel->create($request->validated());
            return $this->responseJson('success', 200);
        } catch (\RuntimeException $exception) {
            return response()->json('error', 500);
        }
    }

    public function edit($id): object
    {
        try {
            return view('admin.city.edit', ['city' => $this->CityModel->findOrFail($id)->toArray()]);
        } catch (ModelNotFoundException $modelNotFoundException) {
            return redirect(route('cities.index'))->with(['error' => __('dashboard.city_not_founded')]);
        }
    }

    public function update($cityUpdateRequest): JsonResponse
    {
        try {
            $this->CityModel->find($cityUpdateRequest->city_id)
                ->update($cityUpdateRequest->validated());
            return $this->responseJson('success', 200);
        } catch (\RuntimeException $exception) {
            return $this->responseJson('error', 500);
        }
    }

    public function destroy($city): object
    {
        try {
            $this->CityModel->findOrFail($city)->delete();
            return redirect(route('cities.index'))->with(['success' => __('dashboard.city_deleted_successfully')]);
        } catch (ModelNotFoundException $modelNotFoundException) {
            return redirect(route('cities.index'))->with(['error' => __('dashboard.city_not_founded')]);
        }
    }

    protected function dropDownControlUser($city)
    {
        return '<div class="btn-group">
                <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">' . __("dashboard.open") . '</button>
                <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuReference1">
                  <a class="dropdown-item" href="' . route('cities.edit', ['city' => $city]) . '">' . __('dashboard.edit_city') . '</a>
                  <a class="dropdown-item" href="' . route('city.destroy', ['city' => $city]) . '">' . __('dashboard.delete_city') . '</a>
                </div>
               </div>';
    }


}
