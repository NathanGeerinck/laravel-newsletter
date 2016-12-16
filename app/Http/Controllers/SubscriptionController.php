<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionsCreateRequest;
use App\Http\Requests\SubscriptionsUpdateRequest;
use App\Models\MailingList;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index(Request $request)
    {
        $subscriptions = Subscription::filter($request->all())
            ->with('mailingList')
            ->paginateFilter(15, ['id', 'email', 'name', 'country', 'language', 'mailing_list_id']);

        $lists = MailingList::get(['name', 'id'])->pluck('name', 'id');

        return view('subscriptions.index', compact('subscriptions', 'lists'));
    }

    public function show(Subscription $subscription)
    {
        return view('subscriptions.show', compact('subscription'));
    }

    public function new(Subscription $subscription)
    {
        $lists = MailingList::get(['name', 'id'])->pluck('name', 'id');

        return view('subscriptions.new', compact('subscription', 'lists'));
    }

    public function edit(Subscription $subscription)
    {
        $lists = MailingList::get(['name', 'id'])->pluck('name', 'id');

        return view('subscriptions.edit', compact('subscription', 'lists'));
    }

    public function create(SubscriptionsCreateRequest $request)
    {
        $request->user()->subscription()->create($request->all());

        return redirect()->route('subscriptions.index');
    }

    public function update(SubscriptionsUpdateRequest $request, Subscription $subscription)
    {
        $subscription->update($request->all());

        return redirect('subscription.show', compact($subscription));
    }
}