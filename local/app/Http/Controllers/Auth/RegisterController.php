<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\employee;
use App\type_users;
use App\users_approved;
use App\team;

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

    public function showRegistrationForm()
    {
        $type_users = type_users::all();
        $team = team::all();
        return view('auth.register', compact('type_users','team'));
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
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'employee_code' => ['required', 'numeric', 'unique:users'],
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
        // $position = type_users::where('id',$data['position'])->first();
        $position = type_users::where('id','2')->first();

        $employee = new employee();
        $employee->username = $data['name'].'   '.$data['surname'];
        $employee->first_name = $data['name'];
        $employee->last_name = $data['surname'];
        $employee->employee_code = $data['employee_code'];
        $employee->position = $position['name_type_users'];
        $employee->save();

        $users_approved = new users_approved();
        $users_approved->username = $data['name'].'   '.$data['surname'];
        $users_approved->users_status = 0;
        $users_approved->save();

        return User::create([
            'username' => $data['name'].'   '.$data['surname'],
            'email' => $data['email'],
            'employee_code' => $data['employee_code'],
            'type_id' => '2',
            'password' => Hash::make($data['password']),
            'code_team_register' => $data['code_team'],
            'users_status' => 0,
        ]);
    }
}
