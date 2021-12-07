<?php

namespace App\DataTables;

use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use App\Models\City;

class CityDataTable extends DataTable
{

    public function ajax()
    {
        $cities = City::select(['id','city_name',
        DB::raw("JSON_VALUE(cities.city_name, '$.en') AS city_name_en"),
        DB::raw("JSON_VALUE(cities.city_name, '$.ar') AS city_name_ar"),
    ]);
        return datatables()->eloquent($cities)
            ->addIndexColumn()
            ->addColumn('action', function ($city) {
                return $this->dropDownControlUser($city->id);
            })
            ->filterColumn("city_name_en", function($query, $keyword) {
                $sql = "JSON_VALUE(cities.city_name, '$.en')  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn("city_name_ar", function($query, $keyword) {
                $sql = "JSON_VALUE(cities.city_name, '$.ar')  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function html()
    {
        return $this->builder()->columns([
            ['data'  =>  'DT_RowIndex', 'name'  =>  'id', 'title' =>  '#'],
            [
                'data' => 'city_name_ar',
                'name' => 'city_name_ar',
                'title' => 'city Name (Arabic)',
            ],
            [
                'data' => 'city_name_en',
                'name' => 'city_name_en',
                'title' => 'city Name (English)',
            ],
            'action'
        ]);
    }

    protected function dropDownControlUser($city)
    {
        return '<div class="btn-group">
                <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">'.__("Open").'</button>
                <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuReference1">
                  <a class="dropdown-item" href="'.route('cities.edit',['city' => $city]).'">'.__('dashboard.edit_city').'</a>
                  <a class="dropdown-item" href="'.route('city.destroy',['city' => $city]).'">'.__('dashboard.delete_city').'</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="'.$city.'">Separated link</a>
                </div>
               </div>';
    }

    protected function filename()
    {
        return 'City_' . date('YmdHis');
    }
   
}
