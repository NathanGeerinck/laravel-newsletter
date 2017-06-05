<?php

namespace App\Http\Controllers;

use App\Models\MailingList;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Requests\SubscriptionsUpdateRequest;
use App\Http\Requests\SubscriptionsCreateRequest;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class SubscriptionController
 * @package App\Http\Controllers
 */
class SubscriptionController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $subscriptions = Subscription::filter($request->all())
            ->with('mailingList')
            ->paginateFilter(15, ['id', 'email', 'name', 'country', 'language', 'mailing_list_id']);

        $lists = MailingList::get(['name', 'id'])->pluck('name', 'id');

        return view('subscriptions.index', compact('subscriptions', 'lists'));
    }

    /**
     * @param Subscription $subscription
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Subscription $subscription)
    {
        $subscription->load('mailingList');

        return view('subscriptions.show', compact('subscription'));
    }

    /**
     * @param Subscription $subscription
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function new(Subscription $subscription)
    {
        $lists = MailingList::get(['name', 'id'])->pluck('name', 'id');

        return view('subscriptions.new', compact('subscription', 'lists'));
    }

    /**
     * @param Subscription $subscription
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Subscription $subscription)
    {
        $lists = MailingList::get(['name', 'id'])->pluck('name', 'id');

        return view('subscriptions.edit', compact('subscription', 'lists'));
    }

    /**
     * @param $email
     * @param $unsubscribe
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function preUnsubscribe($email, $unsubscribe)
    {
        $subscription = Subscription::whereEmail($email)->whereUnsubscribe($unsubscribe)->first();

        abort_unless($subscription, 404);

        return view('subscriptions.unsubscribe', compact('subscription'));
    }

    /**
     * @param SubscriptionsCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(SubscriptionsCreateRequest $request)
    {
        $subscription = $request->user()->subscription()->create($request->all());

        notify()->flash($subscription->email, 'success', [
            'timer' => 2000,
            'text' => 'Successfully created!',
        ]);

        return redirect()->route('subscriptions.index');
    }

    /**
     * @param SubscriptionsUpdateRequest $request
     * @param Subscription $subscription
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SubscriptionsUpdateRequest $request, Subscription $subscription)
    {
        $subscription->update($request->all());

        notify()->flash($subscription->email, 'success', [
            'timer' => 2000,
            'text' => 'Successfully updated!',
        ]);

        return redirect()->route('subscriptions.show', $subscription);
    }

    /**
     * @param Subscription $subscription
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Subscription $subscription)
    {
        $subscription->delete();

        notify()->flash($subscription->email, 'success', [
            'timer' => 2000,
            'text' => 'Successfully deleted!',
        ]);

        return redirect()->route('subscriptions.index');
    }

    /**
     * @param Subscription $subscription
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unsubscribe(Subscription $subscription)
    {
        $subscription->delete();

        notify()->flash('Woehoe!', 'success', [
            'timer' => 3500,
            'text' => 'You\'re successfully unsubscribed!',
        ]);

        return redirect()->route('index');
    }

    /**
     * @param $method
     */
    public function export($method)
    {
        $subscriptions = Subscription::all();

        Excel::create('Newsletter Subscriptions', function ($excel) use ($subscriptions) {
            $excel->sheet('Subscriptions', function ($sheet) use ($subscriptions) {
                $sheet->fromArray($subscriptions);
            });
        })->download($method);
    }
}
