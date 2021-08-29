<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;


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

    use RegistersUsers;

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
        //dd($data);

            return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'typeDoc' => ['required', 'string', 'max:255'],
            'numberDoc' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:255'],
            'cellphone' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'country' => ['required', 'string', 'max:255'],
            //'level' => ['required', 'string', 'max:255'],
            //'photo' => ['required', 'string', 'max:255'],
            //'photoDoc' => ['required', 'string', 'max:255'],
            //'isActive' => ['required', 'Boolean', 'max:255'],
            'ownerId' => ['string', 'max:255'],
            //'role' => ['required', 'string', 'max:255'],
            ]);


    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $urlphoto = asset('img/theme/avatar.png');
        $urlphotoDoc = asset('img/theme/avatar.png');
        $role = 'user';


        return User::create([
            'ownerId' => $data['ownerId'],
            'role' => $role,
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'typeDoc' => $data['typeDoc'],
            'numberDoc' => $data['numberDoc'],
            'phone' => $data['phone'],
            'cellphone' => $data['cellphone'],
            'country' => $data['country'],
            'email' => $data['email'],
            'level' => 'user',
            'photo' => $urlphoto,
            'photoDoc' => $urlphotoDoc,
            'isActive' => true,
            'password' => Hash::make($data['password'])

            ]);

    }
}