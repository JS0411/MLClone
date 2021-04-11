<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserClassifiedsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index (){
        return view('users.classifieds.index');
    }
}
