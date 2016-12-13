<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index()
    {
        return view('campaigns.index');
    }

    public function show()
    {
        return view('campaigns.show');
    }

    public function new()
    {
        return view('campaigns.new');
    }
}
