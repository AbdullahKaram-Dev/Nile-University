<?php
declare(strict_types=1);

namespace App\Http\Controllers\Web\Admin;

use App\Http\Interfaces\Web\Admin\AdminDealInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDealController extends Controller
{
    public AdminDealInterface $adminDealInterface;

    public function __construct(AdminDealInterface $adminDealInterface)
    {
        $this->adminDealInterface = $adminDealInterface;
    }

    public function startupDeals($startupID)
    {
        return $this->adminDealInterface->startupDeals($startupID);
    }

    public function changeDealStatus(Request $request)
    {
       return $this->adminDealInterface->changeDealStatus($request);
    }

    public function destroyDeal(Request $request)
    {
        return $this->adminDealInterface->destroyDeal($request);
    }
}
