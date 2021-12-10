<?php
declare(strict_types=1);

namespace App\Http\Controllers\Web\Admin;

use App\Http\Interfaces\Web\Admin\AdminStartupInterface;
use App\Http\Controllers\Controller;

class AdminStartupController extends Controller
{
    public AdminStartupInterface $adminStartUpInterface;

    public function __construct(AdminStartupInterface $adminStartUpInterface)
    {
        $this->adminStartUpInterface = $adminStartUpInterface;
    }

    public function index()
    {
        return $this->adminStartUpInterface->index();
    }

    public function show($startupID)
    {
        return $this->adminStartUpInterface->showStartupInfo($startupID);
    }

}
