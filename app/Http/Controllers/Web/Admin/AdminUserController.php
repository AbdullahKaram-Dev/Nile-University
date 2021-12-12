<?php
declare(strict_types=1);

namespace App\Http\Controllers\Web\Admin;

use App\Http\Interfaces\Web\Admin\AdminUserInterface;
use App\Http\Requests\Web\Admin\UpdateUserInfo;
use App\Http\Requests\Web\Admin\UpdateUserPassword;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    private AdminUserInterface $AdminUserInterface;

    public function __construct(AdminUserInterface $AdminUserInterface)
    {
        $this->AdminUserInterface = $AdminUserInterface;
    }

    public function index()
    {
        return $this->AdminUserInterface->index();
    }

    public function show($user_id): object
    {
        return $this->AdminUserInterface->show($user_id);
    }

    public function edit($user_id): object
    {
        return $this->AdminUserInterface->edit($user_id);
    }

    public function updateUserPassword(UpdateUserPassword $updateUserPassword): JsonResponse
    {
        return $this->AdminUserInterface->updateUserPassword($updateUserPassword);
    }

    public function deleteUser(Request $request)
    {
        return $this->AdminUserInterface->deleteUser($request);
    }

    public function editUserInfo($user)
    {
        return $this->AdminUserInterface->editUserInfo($user);
    }

    public function updateUserInfo(UpdateUserInfo $updateUserInfo)
    {
        return $this->AdminUserInterface->updateUserInfo($updateUserInfo);
    }
}
