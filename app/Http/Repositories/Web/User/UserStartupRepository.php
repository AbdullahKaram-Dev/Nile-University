<?php
declare(strict_types=1);

namespace App\Http\Repositories\Web\User;

use App\Http\Interfaces\Web\User\UserStartupInterface;
use App\Models\Startup;


class UserStartupRepository implements UserStartupInterface
{
    public Startup $startupModel;

    public function __construct(Startup $startupModel)
    {
        $this->startupModel = $startupModel;
    }


    public function showStartupInfo()
    {
        return view('user.startup.view', ['startup' => $this->startupModel
                ->with(['user:id,name,email', 'city:id,city_name', 'sectors'])
                ->where('user_id', auth()->user()->id)->first()->toArray()]);
    }
}
