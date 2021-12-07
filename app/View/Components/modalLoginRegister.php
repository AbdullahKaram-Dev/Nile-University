<?php

namespace App\View\Components;

use App\Models\FrontCity;
use App\Models\FrontSector;
use Illuminate\View\Component;

class modalLoginRegister extends Component
{

    public function __construct()
    {
    }


    public function render()
    {
        return view('components.modal-login-register');
    }

    public function sectors()
    {
        return FrontSector::get()->toArray();
    }

    public function cities()
    {
        return FrontCity::get()->toArray();
    }
}
