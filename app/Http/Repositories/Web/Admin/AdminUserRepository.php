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
    use UserTrait, GlobalResponse;

    private User $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function index()
    {
        if (request()->ajax()) {
            $users = $this->userModel->whereHas('startup')->select('id', 'name', 'email')->with('startup');
            return datatables()->eloquent($users)
                ->addIndexColumn()
                ->addColumn('action', function ($users) {
                    return $this->dropDownControlUser($users);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.user.index');
    }

    public function show($user_id): object
    {
        try {
            return view('admin.user.show')->with(['user' => $this->userModel->findOrFail($user_id)]);
        } catch (ModelNotFoundException $exception) {
            return redirect(route('users.index'))->with(['error' => __('dashboard.user_not_founded')]);
        }
    }

    public function edit($user_id): object
    {
        try {
            return view('admin.user.edit')->with(['user' => $this->userModel->findOrFail($user_id)]);
        } catch (ModelNotFoundException $exception) {
            return redirect(route('users.index'))->with(['error' => __('dashboard.user_not_founded')]);
        }
    }

    public function updateUserPassword($request): JsonResponse
    {
        try {
            $this->userModel->find($request->user_id)->update(['password' => Hash::make($request->password)]);
            return $this->responseJson('success', 200);
        } catch (\RuntimeException $exception) {
            return $this->responseJson('error', 200);
        }
    }

    protected function dropDownControlUser($user): string
    {
        return '<div class="btn-group">
                <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">' . __("dashboard.open") . '</button>
                <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuReference1">
                  <a class="dropdown-item" href="' . route('admin.edit.user.info', ['user' => $user->id]) . '">' . __('dashboard.edit_user_info') . '</a>
                  <a class="dropdown-item" href="' . route('users.edit', ['user' => $user->id]) . '">' . __('dashboard.edit_password') . '</a>
                  <a class="dropdown-item" onclick="deleteUser('.$user->id.')">' . __('dashboard.delete_user_and_startup') . '</a>
                  <a class="dropdown-item" href="' . route('startups.show', ['startup' => $user->startup->id]) . '">' . __('dashboard.show_startup_and_deals') . '</a>
                </div>
               </div>';
    }

    public function deleteUser($request)
    {
        try {
            $this->userModel->find($request->user_id)->delete();
            return $this->responseJson('success', 200);
        } catch (\Exception $exception) {
            return $this->responseJson('error', 200);
        }
    }

    public function editUserInfo($user)
    {
        try {
            return view('admin.user.edit-info')->with(['user' => $this->userModel->findOrFail($user)]);
        } catch (ModelNotFoundException $exception) {
            return redirect(route('users.index'))->with(['error' => __('dashboard.user_not_founded')]);
        }
    }

    public function updateUserInfo($request):JsonResponse
    {
        try {
            $this->userModel->find($request->user_id)->update($request->only(['name','email']));
            return $this->responseJson('success', 200);
        } catch (\RuntimeException $exception) {
            return $this->responseJson('error', 200);
        }
    }
}
