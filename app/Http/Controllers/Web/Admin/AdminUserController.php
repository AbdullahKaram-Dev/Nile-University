<?php
declare(strict_types=1);

namespace App\Http\Controllers\Web\Admin;

use App\Http\Interfaces\Web\Admin\AdminUserInterface;
use App\Http\Requests\Web\Admin\UpdateUserPassword;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class AdminUserController extends Controller
{
    private AdminUserInterface $AdminUserInterface;

    public function __construct(AdminUserInterface $AdminUserInterface)
    {
        /* test github */
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
}
