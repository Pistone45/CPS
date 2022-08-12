<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //Fetching all the roles
        $roles = Role::all();

        return view('roles/index', [
            'roles' => $roles,
        ]);
        //return view('roles/index');
    }
}
