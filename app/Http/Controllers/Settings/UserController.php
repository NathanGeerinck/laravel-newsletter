<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return view('settings.users.index');
    }
}
