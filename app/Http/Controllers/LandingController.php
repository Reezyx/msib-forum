<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index(){
        return view('index');
    }

    public function formLogin()
    {
        return view('form_login');
    }
    public function formRegister()
    {
        return view('form_register');
    }
}
