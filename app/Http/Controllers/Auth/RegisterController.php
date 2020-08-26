<?php

namespace App\Http\Controllers\Auth;

use App\Model\Core\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function showRegistrationForm()
    {
        return view('auth/register');
    }

    protected function showRegistrationUMKMForm()
    {
        $activeForm = 'umkm_account';
        $activeWizard = [];
        return view('auth/register_stisla', compact('activeForm','activeWizard'));
    }

    protected function umkmAccount(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        session(['register' => array(
            'account' => $data
        )]);
        
        $activeForm = 'umkm_detail';
        $activeWizard = [
            'umkm_detail',
        ];
        return view('auth/register_stisla',compact('activeForm', 'activeWizard'));
    }

    protected function umkmData(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string'],
            'address' => ['required', 'string'],
            'address' => ['required', 'string'],
            'province_id' => ['required', 'numeric'],
            'city_id' => ['required', 'numeric'],
            'district_id' => ['required', 'numeric'],
            'village_id' => ['required', 'numeric'],
            'postal_code' => ['required', 'string', 'max:10'],
        ]);

        session(['register' => array(
            'umkm' => $data
        )]);
        
        $activeForm = 'umkm_picture';
        $activeWizard = [
            'umkm_detail',
            'umkm_picture'
        ];

        return view('auth/register_stisla',compact('activeForm', 'activeWizard'));
    }

    protected function saveUmkmPicture(Request $request)
    {
       dd($request);
    }
}
