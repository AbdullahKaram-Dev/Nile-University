<?php
declare(strict_types=1);

namespace App\Http\Repositories\Web\Admin;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Interfaces\Web\Admin\AdminUserInterface;
use App\Http\Traits\Web\Admin\GlobalResponse;
use App\Http\Traits\Web\User\UserTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use App\Models\User;

class AdminUserRepository implements AdminUserInterface
{
    use UserTrait,GlobalResponse;

    private User $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function index()
    {
        if (request()->ajax()) {
            $users = $this->userModel->select('id','name','email','email_verified_at');
            return datatables()->eloquent($users)
                ->addIndexColumn()
                ->addColumn('email_verified', function ($users) {
                    return $this->isEmailVerified($users->email_verified_at);
                })
                ->addColumn('action', function ($users) {
                    return $this->dropDownControlUser($users->id);
                })
                ->rawColumns(['action', 'email_verified'])
                ->make(true);
        }
        return view('admin.user.index');
    }

    protected function dropDownControlUser($user_id):string
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

    protected function isEmailVerified($email_verified_at):string
    {
        return (!is_null($email_verified_at)) ? '<span class="badge outline-badge-success">'.__('dashboard.verified').'</span>' : '<span class="badge outline-badge-danger">'.__('dashboard.not_verified').'</span>';
    }

    public function show($user_id): object
    {
        try {
            return view('admin.user.show')->with(['user' => $this->userModel->findOrFail($user_id)]);
        } catch (ModelNotFoundException $exception) {
            return redirect(route('users.index'))->with(['error' =>  __('dashboard.user_not_founded')]);
        }
    }

    public function edit($user_id): object
    {
        try {
            return view('admin.user.edit')->with(['user' => $this->userModel->findOrFail($user_id)]);
        } catch (ModelNotFoundException $exception) {
            return redirect(route('users.index'))->with(['error' =>  __('dashboard.user_not_founded')]);
        }
    }

    public function updateUserPassword($request): JsonResponse
    {
        try {
            $this->userModel->find($request->user_id)->update(['password' => Hash::make($request->password)]);
            return $this->responseJson('success',200);
        } catch (\RuntimeException $exception) {
            return $this->responseJson('error',500);
        }
    }
}
