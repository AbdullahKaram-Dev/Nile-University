<?php
declare(strict_types=1);

namespace App\Http\Interfaces\Web\Admin;

use Illuminate\Http\JsonResponse;

interface AdminSectorInterface
{
    public function index();

    public function create():object;

    public function store($request):JsonResponse;

    public function edit($id):object;

    public function update($updateSector):JsonResponse;

    public function destroy($sector): object;
}
