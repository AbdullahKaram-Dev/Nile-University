<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FrontStartup;
use App\Models\FrontDeal;

class HomeController extends Controller
{
    public function index()
    {
        $deals = FrontStartup::with(['deals'=>function($query){
            $query->where('status',1);
        }])->where('deal_status',1)->latest()->limit(6)->get()->toArray();
        return view('web-site-home',compact('deals'));
    }

    public function getDeals()
    {
        $deal = FrontDeal::where('status',1)->inRandomOrder()->limit(1)->get()->toArray();
        return view('deals',compact('deal'));
    }

    public function searchDeals(Request $request)
    {
        $deals = [];
        if (app()->getLocale() == 'en' and $request->search != '')
            $deals = $this->getDealsEnglishSearch($request);
        elseif (app()->getLocale() == 'ar' and $request->search != '')
            $deals = $this->getDealsArabicSearch($request);
       return view('deals-search',compact('deals'));
    }


    private function getDealsEnglishSearch($request)
    {
        return FrontDeal::select(['status', 'id', 'deal_name', 'deal_description', 'deal_value', 'deal_logo'])
            ->where('status',1)
            ->whereRaw("JSON_VALUE(deals.deal_name, '$.en')  like ?",["%{$request->search}%"])
            ->get()->toArray();
    }

    private function getDealsArabicSearch($request)
    {
        return FrontDeal::select(['status', 'id', 'deal_name', 'deal_description', 'deal_value', 'deal_logo'])
            ->where('status',1)
            ->whereRaw("JSON_VALUE(deals.deal_name, '$.ar')  like ?",["%{$request->search}%"])
            ->get()->toArray();
    }

    public function showDealInfo($deal_id)
    {
        dd($deal_id);
    }


}
