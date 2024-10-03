<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeControllers extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function loginPage() {
        return view('login');
    }
}
