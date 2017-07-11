<?php

namespace App\Http\Controllers\Api;

use Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MailGunController extends Controller
{
    public function view(Request $request)
    {
        Event::fire(new MailGun\EmailViewed);
    }
}