<?php
declare(strict_types=1);

namespace App\Http\Repositories\Web\Admin;
use App\Http\Interfaces\Web\Admin\AdminHomeInterface;

class AdminHomeRepository implements AdminHomeInterface
{
    public function index()
    {
        return view('admin.home.index');
    }
}
