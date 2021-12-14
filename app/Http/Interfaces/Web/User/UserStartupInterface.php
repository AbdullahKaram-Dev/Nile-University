<?php
declare(strict_types=1);

namespace App\Http\Interfaces\Web\User;

interface UserStartupInterface
{
    public function showStartupInfo();

    public function edit();

    public function updateStartup($request);
}
