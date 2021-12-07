<?php

namespace App\DataTables;

use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use App\Models\Sector;

class SectorDataTable extends DataTable
{

    public function ajax()
    {
        $sectors = Sector::select(['id','sector_name',
        DB::raw("JSON_VALUE(sectors.sector_name, '$.en') AS sector_name_en"),
        DB::raw("JSON_VALUE(sectors.sector_name, '$.ar') AS sector_name_ar"),
    ]);
        return datatables()->eloquent($sectors)
            ->addIndexColumn()
            ->addColumn('action', function ($sector) {
                return $this->dropDownControlUser($sector->id);
            })
            ->filterColumn("sector_name_en", function($query, $keyword) {
                $sql = "JSON_VALUE(sectors.sector_name, '$.en')  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn("sector_name_ar", function($query, $keyword) {
                $sql = "JSON_VALUE(sectors.sector_name, '$.ar')  like ?";
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
                'data' => 'sector_name_ar',
                'name' => 'sector_name_ar',
                'title' => 'sector Name (Arabic)',
            ],
            [
                'data' => 'sector_name_en',
                'name' => 'sector_name_en',
                'title' => 'sector Name (English)',
            ],
            'action'
        ]);
    }

    protected function dropDownControlUser($sector)
    {
        return '<div class="btn-group">
                <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">'.__("Open").'</button>
                <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuReference1">
                  <a class="dropdown-item" href="'.route('sectors.edit',['sector' => $sector]).'">'.__('dashboard.edit_sector').'</a>
                  <a class="dropdown-item" href="'.route('sector.destroy',['sector' => $sector]).'">'.__('dashboard.delete_sector').'</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="'.$sector.'">Separated link</a>
                </div>
               </div>';
    }

    protected function filename()
    {
        return 'Sector_' . date('YmdHis');
    }
   
}
