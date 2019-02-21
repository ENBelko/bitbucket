<?php

namespace App\Http\Controllers\Auth;

use App\Role;
use App\User;
use App\Http\Controllers\Controller;
use function GuzzleHttp\Psr7\str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
    protected $redirectTo = '/home';

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
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        /*2-ух пользователей admin быть не может,регистр не важен*/
        if (strtolower($data['name'] == 'admin') && strtolower($data['password']) == 'admin') {
            /*$data['name'] = 'Admin';
            $data['password'] = 'Admin';*/
            $role_id = Role::firstOrCreate(['slug' =>'admin','name' => 'Administrator'])->id;
        } else if(strtolower($data['name']) == 'eventer1' && strtolower($data['password']) == 'eventer1'){
            $data['name'] = 'Eventer1';
            $data['password'] = 'Eventer1';
            $role_id = Role::firstOrCreate(['slug' =>'eventer1','name' => 'Event-owner1'])->id;
        } else if (strtolower($data['name']) == 'eventer2' && strtolower($data['password']) == 'eventer2') {
            $data['name'] = 'Eventer2';
            $data['password'] = 'Eventer2';
            $role_id = Role::firstOrCreate(['slug' => 'eventer2', 'name' => 'Event-owner2'])->id;
        } else {
            $role_id = Role::firstOrCreate(['slug' => 'user', 'name' => 'Ordinary-user'])->id;
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);



        /*фикс роли*/
        DB::table('user_roles')->insert([
            'user_id' => $user->id,
            'role_id' => $role_id]);

        return $user;
    }
}
