<?php

namespace App\Http\Controllers;

use App\Models\MailingList;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Requests\SubscriptionsUpdateRequest;
use App\Http\Requests\SubscriptionsCreateRequest;
use Maatwebsite\Excel\Facades\Excel;

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
        $subscription->load('mailingList');

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

    public function preUnsubscribe($email, $unsubscribe)
    {
        $subscription = Subscription::whereEmail($email)->whereUnsubscribe($unsubscribe)->first();

        abort_unless($subscription, 404);

        return view('subscriptions.unsubscribe', compact('subscription'));
    }

    public function create(SubscriptionsCreateRequest $request)
    {
        $subscription = $request->user()->subscription()->create($request->all());

        notify()->flash($subscription->email, 'success', [
            'timer' => 2000,
            'text' => 'Successfully created!',
        ]);

        return redirect()->route('subscriptions.index');
    }

    public function update(SubscriptionsUpdateRequest $request, Subscription $subscription)
    {
        $subscription->update($request->all());

        notify()->flash($subscription->email, 'success', [
            'timer' => 2000,
            'text' => 'Successfully updated!',
        ]);

        return redirect()->route('subscriptions.show', $subscription);
    }

    public function delete(Subscription $subscription)
    {
        $subscription->delete();

        notify()->flash($subscription->email, 'success', [
            'timer' => 2000,
            'text' => 'Successfully deleted!',
        ]);

        return redirect()->route('subscriptions.index');
    }

    public function unsubscribe(Subscription $subscription)
    {
        $subscription->delete();

        notify()->flash('Woehoe!', 'success', [
            'timer' => 3500,
            'text' => 'You\'re successfully unsubscribed!',
        ]);

        return redirect()->route('index');
    }

    public function export()
    {
        $subscriptions = Subscription::all();

        Excel::create('Newsletter Subscriptions', function ($excel) use ($subscriptions) {
            $excel->sheet('Subscriptions', function ($sheet) use ($subscriptions) {
                $sheet->fromArray($subscriptions);
            });
        })->export('csv');
    }
}