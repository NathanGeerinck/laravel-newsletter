<?php

namespace App\Http\Controllers;

use App\Models\Subscriptions;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscriptions::latest()
            ->paginate(15, ['id', 'email', 'name', 'country', 'language']);

        return view('subscriptions.index', compact('subscriptions'));
    }

    public function show()
    {
        return view('subscriptions.show');
    }

    public function new()
    {
        return view('subscriptions.new');
    }
}
