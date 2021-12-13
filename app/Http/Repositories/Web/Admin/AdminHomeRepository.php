<?php
declare(strict_types=1);

namespace App\Http\Repositories\Web\Admin;

use App\Http\Interfaces\Web\Admin\AdminHomeInterface;
use App\Models\Startup;
use App\Models\Deal;
use App\Models\User;

class AdminHomeRepository implements AdminHomeInterface
{
    private const DEAL_STATUS = ['pending'=>0,'approval'=>1,'rejected'=>2];
    private const STARTUP_STATUS = ['blocked'=>0,'active'=>1];

    public function index()
    {
        return view('admin.home.index',[
            'deals' => $this->getDealsStaticsCount(),
            'startups' => $this->getStartupStaticsCount(),
            'users' => $this->getUsersStaticsCount()
        ]);
    }

    private function getDealsStaticsCount():array
    {
        $all_deals = Deal::all();
        return [
            'approval_deals' => $all_deals->where('status',self::DEAL_STATUS['approval'])->count(),
            'pending_deals' => $all_deals->where('status',self::DEAL_STATUS['pending'])->count(),
            'rejected_deals' => $all_deals->where('status',self::DEAL_STATUS['rejected'])->count()
        ];
    }

    private function getStartupStaticsCount():array
    {
        $all_startups = Startup::all();
        return [
            'active_startups' => $all_startups->where('status',self::STARTUP_STATUS['active'])->count(),
            'blocked_startups' => $all_startups->where('status',self::STARTUP_STATUS['blocked'])->count()
        ];
    }

    private function getUsersStaticsCount():array
    {
        return [
            'users_count' => User::count(),
        ];
    }
}
