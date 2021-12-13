<?php
declare(strict_types=1);

namespace App\Http\Interfaces\Web\Admin;

interface AdminStartupInterface
{
    public function index();

    public function showStartupInfo($startupID);

    public function create();

    public function createUserStartup($request);

    public function changeStartupStatus($request);

    public function changeStartupDealStatus($request);
}
