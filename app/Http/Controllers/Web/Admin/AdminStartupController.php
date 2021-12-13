<?php
declare(strict_types=1);

namespace App\Http\Controllers\Web\Admin;

use App\Http\Interfaces\Web\Admin\AdminStartupInterface;
use App\Http\Requests\Web\Admin\ChangeStartupDealStatus;
use App\Http\Requests\Web\Admin\ChangeStartupStatus;
use App\Http\Requests\Web\Admin\StoreUserStartup;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\UpdateStartup;
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
        return $this->adminStartUpInterface->showStartupInfo($startupID);
    }

    public function create()
    {
        return $this->adminStartUpInterface->create();
    }

    public function createUserStartup(StoreUserStartup $storeUserStartup)
    {
        return $this->adminStartUpInterface->createUserStartup($storeUserStartup);
    }

    public function changeStartupStatus(ChangeStartupStatus $changeStartupStatus)
    {
        return $this->adminStartUpInterface->changeStartupStatus($changeStartupStatus);
    }

    public function changeStartupDealStatus(ChangeStartupDealStatus $changeStartupDealStatus)
    {
        return $this->adminStartUpInterface->changeStartupDealStatus($changeStartupDealStatus);
    }

    public function edit($startup_id)
    {
        return $this->adminStartUpInterface->edit($startup_id);
    }

    public function updateStartup(UpdateStartup $updateStartup)
    {
        return $this->adminStartUpInterface->updateStartup($updateStartup);
    }

}
