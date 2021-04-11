<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = $request->user();
        return view('users.index', compact('user'));
    }
}
