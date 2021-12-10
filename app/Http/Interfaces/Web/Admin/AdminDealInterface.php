<?php
declare(strict_types=1);

namespace App\Http\Interfaces\Web\Admin;

interface AdminDealInterface
{
    public function startupDeals($startupID);

    public function changeDealStatus($request);
}
