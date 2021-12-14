<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserHomeController extends Controller
{
    public function __construct()
    {
        /* verified middleware for emails */
        $this->middleware(['auth']);
    }

    public function index()
    {
        return view('user.home.home');
    }
}
