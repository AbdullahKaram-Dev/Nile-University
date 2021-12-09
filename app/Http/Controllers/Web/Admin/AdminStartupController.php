<?php
declare(strict_types=1);
namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Web\Admin\AdminStartupInterface;
use Illuminate\Http\Request;

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
        return $this->adminStartUpInterface->showStartupWithDeals($startupID);
    }
}
