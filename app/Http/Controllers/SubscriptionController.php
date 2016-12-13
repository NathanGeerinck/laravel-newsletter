<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        return view('subscription.index');
    }

    public function show()
    {
        return view('subscription.show');
    }

    public function add()
    {
        return view('subscription.add');
    }
}
