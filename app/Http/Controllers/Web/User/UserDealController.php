<?php
declare(strict_types=1);
namespace App\Http\Controllers\Web\User;

use App\Http\Interfaces\Web\User\UserDealStartupInterface;
use App\Http\Requests\Web\User\StoreDealRequest;
use App\Http\Requests\Web\User\UpdateDealRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserDealController extends Controller
{
    public UserDealStartupInterface $userDealStartupInterface;

    public function __construct(UserDealStartupInterface $userDealStartupInterface)
    {
        $this->userDealStartupInterface = $userDealStartupInterface;
    }

    public function getDealStartup($startup_id)
    {
        return $this->userDealStartupInterface->getDealStartup($startup_id);
    }

    public function destroyDeal(Request $request)
    {
        return $this->userDealStartupInterface->destroyDeal($request);
    }

    public function editDeal($deal_id)
    {
        return $this->userDealStartupInterface->editDeal($deal_id);
    }

    public function updateDeal(UpdateDealRequest $updateDealRequest)
    {
        return $this->userDealStartupInterface->updateDeal($updateDealRequest);
    }

    public function createDeal()
    {
        return $this->userDealStartupInterface->createDeal();
    }

    public function storeDeal(StoreDealRequest $storeDealRequest)
    {
        return $this->userDealStartupInterface->storeDeal($storeDealRequest);
    }


}
