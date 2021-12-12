<?php
declare(strict_types=1);

namespace App\Http\Interfaces\Web\Admin;

use Illuminate\Http\JsonResponse;

interface AdminUserInterface
{
    public function index();

    public function show($user_id):object;

    public function edit($user_id):object;

    public function updateUserPassword($request):JsonResponse;

    public function deleteUser($request);

    public function editUserInfo($user);

    public function updateUserInfo($request);
}
