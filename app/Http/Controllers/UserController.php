<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Gender;
use App\Models\User;
use App\Models\Role;

use DataTables;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Get all users
    public function index()
    {
        //Fetching all the users
        $users = User::all();

        return view('users/index', [
            'users' => $users,
        ]);
    }

    public function get(Request $request)
    {
        if ($request->ajax()) {

        $users = User::with('role')->orderBy('created_at', 'DESC')->get();

            return Datatables::of($users)
                    ->addIndexColumn()
                    ->make(true);
        }
    }

    //Returns form for adding users
    public function add()
    {
        //Fetching roles and genders
        $roles = Role::all();
        $genders = Gender::all();

        return view('users/add', ['roles' => $roles, 'genders' => $genders]);
    }

    public function register()
    {
        try{

        request()->validate([
         'first_name' => ['required', 'string', 'max:40'],
         'last_name' => ['required', 'string', 'max:40'],
         'phone' => 'required|regex:/(265)[0-9]/|not_regex:/[a-z]/|min:9',
         'address' => ['required', 'string', 'max:100'],
         'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
        ]);

        $check_user = User::where('email', request('email'))->first();

        // if($check_user != null){
        //     return back()->withError("This email address is already taken")->withInput();
        // }

        //Generate random string
        // Available alpha caracters
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // generate a pin based on 2 * 7 digits + a random character
        $pin = mt_rand(1000000, 9999999)
            . mt_rand(1000000, 9999999)
            . $characters[rand(0, strlen($characters) - 1)];

        // shuffle the result
        $password = str_shuffle($pin);
        $pass = "Pistone45";

        $first_name = request('first_name');
        $last_name = request('last_name');
        $email = request('email');
        $address = request('address');
        $phone = request('phone');
        $role_id = request('role_id');
        $gender_id = request('gender_id');
        $hash_password = Hash::make($pass);

        //Saving the user
        $user = new User();
        $user->email = $email;
        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->phone = $phone;
        $user->address = $address;
        $user->gender_id = $gender_id;
        $user->role_id = $role_id;
        $user->password = $hash_password;
        $user->save();

        // $basic  = new \Nexmo\Client\Credentials\Basic('c1f4b985', 'hE9dEfYXYgsnfxxP');
        //         $client = new \Nexmo\Client($basic);
         
        //         $message = $client->message()->send([
        //             'to' => ''.$phone.'',
        //             'from' => 'Airtel EMS',
        //             'text' => 'An account was created on the EMS System. Your username is: '.$username.' and your password is: '.$pass.' Login using these credentials to access your account'
        //         ]);

        return redirect()->back()->with('message', 'You have successfully registered this user');

    } catch (Exception $e) {
        return back()->withError("Failed to add User")->withInput();
    }

    }

    //Returns form for editing users
    public function editform(User $user)
    {
        //Fetching roles and genders
        $roles = Role::all();
        $genders = Gender::all();

        return view('users/edit', ['user' => $user, 'roles' => $roles, 'genders' => $genders]);
    }

    public function update(User $user)
    {
        request()->validate([
         'first_name' => ['required', 'string', 'max:40'],
         'last_name' => ['required', 'string', 'max:40'],
         'phone' => 'required|regex:/(265)[0-9]/|not_regex:/[a-z]/|min:9',
         'address' => ['required', 'string', 'max:100']
        ]);
        
    }


}
