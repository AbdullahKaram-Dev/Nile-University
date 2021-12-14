<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\UpdateAdminInfo;
use App\Http\Traits\Web\Admin\GlobalResponse;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    use GlobalResponse;

    public function edit()
    {
        $adminInfo = Admin::findOrFail(auth()->guard('admin')->user()->id);
        return view('admin.account.edit',compact('adminInfo'));
    }

    public function update(UpdateAdminInfo $updateAdminInfo)
    {
        try {
            $updateData = $updateAdminInfo->only(['name','email','password']);
            if (!is_null($updateData['password']))
                $updateData['password'] = Hash::make($updateData['password']);
            else
                unset($updateData['password']);
            Admin::find(auth()->guard('admin')->user()->id)
                   ->update($updateData);
            return $this->responseJson('success',200);
        }catch (\Exception $exception){
            return $this->responseJson('error',200);
        }
    }
}
