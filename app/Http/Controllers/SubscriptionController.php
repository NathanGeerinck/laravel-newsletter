<?php

namespace App\Http\Controllers;

use App\Models\MailingList;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\SubscriptionRequest;

/**
 * Class SubscriptionController.
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
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Subscription $subscription)
    {
        $this->authorize('view', $subscription);

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
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Subscription $subscription)
    {
        $this->authorize('update', $subscription);

        $lists = MailingList::get(['name', 'id'])->pluck('name', 'id');

        return view('subscriptions.edit', compact('subscription', 'lists'));
    }

    /**
     * @param SubscriptionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(SubscriptionRequest $request)
    {
        $subscription = $request->user()->subscription()->create($request->all());

        notify()->flash($subscription->email, 'success', [
            'timer' => 2000,
            'text' => trans('general.success.created'),
        ]);

        return redirect()->route('subscriptions.index');
    }

    /**
     * @param SubscriptionRequest $request
     * @param Subscription $subscription
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(SubscriptionRequest $request, Subscription $subscription)
    {
        $this->authorize('update', $subscription);

        $subscription->update($request->all());

        notify()->flash($subscription->email, 'success', [
            'timer' => 2000,
            'text' => trans('general.success.update'),
        ]);

        return redirect()->route('subscriptions.show', $subscription);
    }

    /**
     * @param Subscription $subscription
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(Subscription $subscription)
    {
        $this->authorize('delete', $subscription);

        $subscription->delete();

        notify()->flash($subscription->email, 'success', [
            'timer' => 2000,
            'text' => trans('general.success.delete'),
        ]);

        return redirect()->route('subscriptions.index');
    }

    /**
     * @param $method
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function export($method)
    {
        $subscriptions = Subscription::all();

        $this->authorize('view', $subscriptions->first());

        Excel::create('Newsletter Subscriptions', function ($excel) use ($subscriptions) {
            $excel->sheet('Subscriptions', function ($sheet) use ($subscriptions) {
                $sheet->fromArray($subscriptions);
            });
        })->download($method);
    }
}
