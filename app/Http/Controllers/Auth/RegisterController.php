<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Traits\Web\Admin\ValidationResponse;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Traits\Web\Startup\StartUpTrait;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Startup;
use App\Models\User;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers,ValidationResponse,StartUpTrait;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validation =  Validator::make($data, [
            'name' => ['required', 'string','min:5','max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'sector_ids' => ['array','required'],
            'sector_ids.*' => ['exists:sectors,id'],
            'startup_logo' => ['required','image','mimes:jpg,png,jpeg,gif,svg','max:2000'],
            'city_id' => ['required','exists:cities,id'],
            'startup_name' => ['required','string','min:5','max:100','unique:startups,startup_name']
        ]);

        if($validation->fails()){

            throw new HttpResponseException($this
                ->validationToJson(['success' => false,'error' => $validation->errors()->toArray()]));
        }
        return $validation;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data,Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
         ]);

        $startUp = Startup::create([
            'startup_name' => $request->startup_name,
            'user_id' => $user->id,
            'city_id' => $request->city_id,
            'startup_logo' => $this->uploadStartUpAvatar($request->startup_logo)
        ]);

        $startUp->sectors()->sync($request->input('sector_ids'));
        return $user;
    }
}
