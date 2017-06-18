<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\User;
use DB;
use jdavidbakr\MailTracker\Model\SentEmail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     */
    public function index()
    {
        return view('home');
    }
}