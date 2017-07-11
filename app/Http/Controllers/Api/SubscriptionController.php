<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\SubscriptionsCreateRequest;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriptionController extends Controller
{
    public function subscriptions()
    {
        $subscriptions = Subscription::get();

        return $subscriptions;
    }

    public function create(SubscriptionsCreateRequest $request)
    {
        $subscription = new Subscription($request->all());
        $subscription->email = $request->email;
        $subscription->name = $request->name;
        $subscription->country = $request->country;
        $subscription->mailing_list_id = $request->mailing_list_id;
//        $subscription->user()->associate(1);
    }
}