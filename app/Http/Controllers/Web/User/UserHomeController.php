<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\Deal;
use App\Models\Startup;
use App\Models\User;
use Illuminate\Http\Request;

class UserHomeController extends Controller
{
    private const DEAL_STATUS = ['pending'=>0,'approval'=>1,'rejected'=>2];

    public function __construct()
    {
        $this->middleware(['auth','BlockedStartup']);
    }

    public function index()
    {
        $deals = $this->getDealsStaticsCount(Startup::where('user_id',auth()->user()->id)->first()->id);
        return view('user.home.home',compact('deals'));
    }

    private function getDealsStaticsCount($startup_id):array
    {
        $all_deals = Deal::all();
        return [
            'approval_deals' => $all_deals->where('status',self::DEAL_STATUS['approval'])
                                          ->where('startup_id',$startup_id)->count(),
            'pending_deals'  => $all_deals->where('status',self::DEAL_STATUS['pending'])
                                          ->where('startup_id',$startup_id)->count(),
            'rejected_deals' => $all_deals->where('status',self::DEAL_STATUS['rejected'])
                                          ->where('startup_id',$startup_id)->count()
        ];
    }

}
