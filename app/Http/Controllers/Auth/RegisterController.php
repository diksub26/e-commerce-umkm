<?php

namespace App\Http\Controllers\Auth;

use App\Model\Core\Umkm;
use App\Model\Core\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    private $_formRegisterUmkm = [
        1 => 'formAccount',
        2 => 'formUmkmDetail',
        3 => 'formUmkmLogo'
    ];

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
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->attachRole('reseller');
        return $user;
    }

    protected function showRegistrationForm()
    {
        return view('auth/register');
    }

    protected function umkmAccount(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
    
            session(['register' => array(
                'account' => $data,
                'lastForm' => 2
            )]);
            
            return redirect()->route('register.'. $this->_formRegisterUmkm[2]);    
        }else{
            $formData = $request->session()->get('register.account');
            //show form Umkm Acoount
            $activeForm = 'umkm_account';
            return view('auth/register_umkm',compact('activeForm', 'formData'));
        }
    }

    protected function umkmData(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->validate([
                'name' => ['required', 'string', 'max:100'],
                'no_telp' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:8', 'max:30'],
                'description' => ['required', 'string'],
                'address' => ['required', 'string'],
                'address' => ['required', 'string'],
                'province_id' => ['required', 'numeric'],
                'city_id' => ['required', 'numeric'],
                'district_id' => ['required', 'numeric'],
                'village_id' => ['required', 'numeric'],
                'postal_code' => ['required', 'string', 'max:10'],
            ]);
                
            $request->session()->put('register.umkm', $data);
            $request->session()->put('register.lastForm', 3);
            
            // show form umkm logo
            return redirect()->route('register.'. $this->_formRegisterUmkm[3]);
        }else{
            $last_form = $request->session()->get('register.lastForm');
            if($last_form == 4){
                return redirect()->route('register.umkmFinish');
            }
            if($last_form < 2){
                return redirect()->route('register.'. $this->_formRegisterUmkm[1]);
            }

            $formData = $request->session()->get('register.umkm');
            //show form Umkm Detail
            $activeForm = 'umkm_detail';
            return view('auth/register_umkm',compact('activeForm', 'formData'));
        }
    }

    protected function umkmPicture(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'logo-umkm' => ['image', 'mimes:jpeg,bmp,png', 'max:6000'],
            ]);
            DB::beginTransaction();
            try {
                $data = $request->session()->get('register.account');
                $data['password'] = Hash::make($data['password']);
                $user = User::create($data);

                $user->attachRole('umkm');
                $data = $request->session()->get('register.umkm');
                $logo = $request->file('logo-umkm')->store('public/logo-umkm');
                $data['user_id'] = $user->id;
                $data['umkm_pic'] = $logo;
                $umkm =  UMKM::create($data);
                DB::commit();
                
                $resp = array(
                    'status' => 'Success',
                    'msg' => 'Data Berhasil disimpan.'
                );
                $request->session()->forget('register');
                session(['register' => array(
                    'lastForm' => 4
                )]);
                return response()->json($resp, 200);
            } catch (\Throwable $th) {
                DB::rollback();
                $resp = array(
                    'status' => 'Error',
                    'msg' => 'Oops, Something went wrong in our server, Please Try Again.'
                );

                if(env("APP_DEBUG") == true){
                    $resp['msg'] = $th->getMessage();
                }
                return response()->json($resp, 500);
            }
        }else{
            $last_form = $request->session()->get('register.lastForm');
            if($last_form == 4){
                return redirect()->route('register.umkmFinish');
            }
            if($last_form < 3){
                return redirect()->route('register.'. $this->_formRegisterUmkm[2]);
            }

            $activeForm = 'umkm_picture';
            return view('auth/register_umkm',compact('activeForm'));
        }
    }

    protected function umkmFinish(Request $request){
        $last_form = $request->session()->get('register.lastForm');
        if($last_form < 4){
            if($last_form == 3){
                return redirect()->route('register.'. $this->_formRegisterUmkm[3]);
            }
            $last_form = $last_form - 1;
            $last_form = ($last_form < 1 ? 1 : $last_form);
            return redirect()->route('register.'. $this->_formRegisterUmkm[$last_form]);
        }

        //show finish view
        $activeForm = 'umkm_finish';
        return view('auth/register_umkm',compact('activeForm'));
    }
}
