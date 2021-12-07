<?php
declare(strict_types=1);

namespace App\Http\Controllers\Web\Admin;

use App\Http\Interfaces\Web\Admin\AdminHomeInterface;
use App\Http\Controllers\Controller;

class AdminHomeController extends Controller
{
    private AdminHomeInterface $AdminHomeInterface;

    public function __construct(AdminHomeInterface $AdminHomeInterface)
    {
        $this->AdminHomeInterface = $AdminHomeInterface;
    }

    public function index()
    {
        return $this->AdminHomeInterface->index();
    }
}
