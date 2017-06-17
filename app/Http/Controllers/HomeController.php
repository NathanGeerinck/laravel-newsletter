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
        $opens = SentEmail::selectRaw('MONTH(created_at) as month, sum(opens) as opens')
            ->groupBy('month')
            ->pluck('opens', 'month');

//        dd($opens);

        Email::create([
            'campaign_id' => 1,
            'message_id' => '20'
        ]);

//        $mails = SentEmail::where('id', 38)->get();

//        $mails->getHeader('campaign_id');

        dd($this->getHeader('campaign_id', SentEmail::where('id', 38)->pluck('headers')));

        return view('home', compact('opens'));
    }
}