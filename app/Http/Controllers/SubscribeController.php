<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscribeRequest;
use App\Models\MailingList;
use App\Models\Subscription;

class SubscribeController extends Controller
{
    /**
     * @param MailingList $list
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function mailing_list(MailingList $list)
    {
        abort_unless($list->public, 404);

        return view('subscribe.list', compact('list'));
    }

    /**
     * @param SubscribeRequest $request
     * @param MailingList $list
     * @return \Illuminate\Http\RedirectResponse
     */
    public function subscribe(SubscribeRequest $request, MailingList $list)
    {
        $subscription = $list->subscriptions()->create($request->all());



        notify()->flash($list->name, 'success', [
            'timer' => 2000,
            'text' => trans('subscriptions.subscribe.success'),
        ]);

        return redirect()->back();
    }

    /**
     * @param $email
     * @param $unSubscribe
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function preUnSubscribe($email, $unSubscribe)
    {
        $subscription = Subscription::whereEmail($email)->whereUnsubscribe($unSubscribe)->first();

        abort_unless($subscription, 404);

        return view('subscriptions.unsubscribe', compact('subscription'));
    }

    /**
     * @param Subscription $subscription
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unSubscribe(Subscription $subscription)
    {
        $subscription->delete();

        notify()->flash(trans('general.woohoo'), 'success', [
            'timer' => 3500,
            'text' => trans('subscriptions.unsubscribe.success'),
        ]);

        return redirect()->route('index');
    }
}