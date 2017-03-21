<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }
    /**
     * Show the application homepage.
     *
     */
    public function index()
    {
        return view('index');
    }

}
