<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthenticatedUserController extends Controller
{
    function index() {
        return view('userhome');
    }

    function contact() {
        return view('user.layouts.contact');
    }
}
