<?php
declare(strict_types=1);

namespace App\Http\Interfaces\Web\User;

interface UserDealStartupInterface
{
    public function getDealStartup($startup_id);

    public function destroyDeal($request);

    public function editDeal($deal_id);

    public function updateDeal($request);

    public function createDeal();

    public function storeDeal($request);
}
