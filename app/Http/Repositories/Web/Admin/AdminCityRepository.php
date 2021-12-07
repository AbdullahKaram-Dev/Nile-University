<?php
declare(strict_types=1);

namespace App\Http\Repositories\Web\Admin;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Interfaces\Web\Admin\AdminCityInterface;
use App\Http\Traits\Web\Admin\GlobalResponse;
use Illuminate\Http\JsonResponse;
use App\DataTables\CityDataTable;
use App\Models\City;

class AdminCityRepository implements AdminCityInterface
{

    use GlobalResponse;
    private City $CityModel;

    public function __construct(City $CityModel)
    {
        $this->CityModel = $CityModel;
    }

    public function index(CityDataTable $cityDataTable): object
    {
        return $cityDataTable->render('admin.city.index');
    }

    public function create(): object
    {
         return view('admin.city.create');
    }

     public function store($request): JsonResponse
     {
         try {
             $this->CityModel->create($request->validated());
             return $this->responseJson('success',200);
         } catch (\RuntimeException $exception) {
             return response()->json('error',500);
         }
     }

     public function edit($id): object
     {
         try {
             return view('admin.city.edit', ['city' => $this->CityModel->findOrFail($id)->toArray()]);
         } catch (ModelNotFoundException $modelNotFoundException) {
             return redirect(route('cities.index'))->with(['error' => __('dashboard.cities_not_founded')]);
         }
     }

     public function update($cityUpdateRequest): JsonResponse
     {         
         try {
             $this->CityModel->find($cityUpdateRequest->city_id)
             ->update($cityUpdateRequest->validated());
             return $this->responseJson('success',200);
         } catch (\RuntimeException $exception) {
             return $this->responseJson('error',500);
         }
     }

     public function destroy($city): object
     {
        try {
            $this->CityModel->findOrFail($city)->delete();
            return redirect(route('cities.index'))->with(['success' => __('dashboard.city_deleted_successfully_')]);
        } catch (ModelNotFoundException $modelNotFoundException) {
            return redirect(route('cities.index'))->with(['error' => __('dashboard.city_not_founded')]);
        }
     }

}
