<?php

namespace App\DataTables;

use Illuminate\Support\Carbon;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use App\Models\User;

class UserDataTable extends DataTable
{
    public function ajax()
    {
        $users = User::select('id','name','email','email_verified_at');
        return datatables()->eloquent($users)
            ->addIndexColumn()
            ->addColumn('email_verified', function ($users) {
                return $this->isEmailVerified($users->email_verified_at);
            })
            ->addColumn('action', function ($users) {
                return $this->dropDownControlUser($users->id);
            })
            ->rawColumns(['action','email_verified'])
            ->make(true);
    }

    public function html()
    {
        return $this->builder()->columns([
            ['data'  =>  'DT_RowIndex', 'name'  =>  'id', 'title' =>  '#'],
            'name','email','email_verified','action'
        ]);
    }

    protected function filename()
    {
        return 'User_' . date('YmdHis');
    }

    protected function dropDownControlUser($user_id)
    {
        return '<div class="btn-group">
                <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">'.__("Open").'</button>
                <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuReference1">
                  <a class="dropdown-item" href="'.route('users.edit',['user' => $user_id]).'">'.__('dashboard.edit_password').'</a>
                  <a class="dropdown-item" href="'.$user_id.'">Subscriptions</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="'.$user_id.'">Separated link</a>
                </div>
               </div>';
    }

    protected function isEmailVerified($email_verified_at)
    {
        return (!is_null($email_verified_at)) ? '<span class="badge outline-badge-success">'.__('dashboard.verified').'</span>' : '<span class="badge outline-badge-danger">'.__('dashboard.not_verified').'</span>';
    }

}
