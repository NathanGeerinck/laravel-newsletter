<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;

/**
 * Class UserController
 * @package App\Http\Controllers\Settings
 */
class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('settings.users.index');
    }
}
