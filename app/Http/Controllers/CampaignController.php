<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Template;
use App\Jobs\SendCampaign;
use App\Models\MailingList;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\CampaignCreateRequest;
use App\Http\Requests\CampaignUpdateRequest;

/**
 * Class CampaignController.
 */
class CampaignController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $campaigns = auth()->user()->campaigns()
            ->filter($request->all())
            ->with('mailingLists')
            ->paginateFilter(15, ['id', 'name', 'send']);

        return view('campaigns.index', compact('campaigns'));
    }

    /**
     * @param Campaign $campaign
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Campaign $campaign)
    {
        $this->authorize('view', $campaign);

        $campaign->load('template', 'mailingLists.subscriptions');

        $subscriptions = $campaign->getSubscriptions();

        return view('campaigns.show', compact('campaign', 'mailingLists', 'subscriptions'));
    }

    /**
     * @param Campaign $campaign
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function new(Campaign $campaign)
    {
        if (request()->is('campaigns/clone*')) {
            $campaign->load('mailingLists');

            $mailingLists = $campaign->getMailingList()->pluck('id')->toArray();
        }

        $lists = MailingList::get(['name', 'id'])->pluck('name', 'id');
        $templates = Template::get(['name', 'id'])->pluck('name', 'id');

        return view('campaigns.new', compact('campaign', 'lists', 'templates', 'mailingLists'));
    }

    /**
     * @param Campaign $campaign
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Campaign $campaign)
    {
        $this->authorize('edit', $campaign);

        abort_if($campaign->send, 404);

        //$campaign->load('mailingLists');

        $lists = MailingList::get(['name', 'id'])->pluck('name', 'id');
        $templates = Template::get(['name', 'id'])->pluck('name', 'id');

        $mailingLists = $campaign->getMailingList()->pluck('id')->toArray();

        return view('campaigns.edit', compact('campaign', 'lists', 'templates', 'mailingLists'));
    }

    /**
     * @param Campaign $campaign
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function preSend(Campaign $campaign)
    {
        $this->authorize('send', $campaign);

        abort_if($campaign->send, 404);

        $campaign->load('template', 'mailingLists.subscriptions');

        $subscriptions = $campaign->getSubscriptions();

        return view('campaigns.send', compact('campaign', 'mailingLists', 'subscriptions'));
    }

    /**
     * @param CampaignCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(CampaignCreateRequest $request)
    {
        $campaign = auth()->user()->campaigns()->create($request->all());

        if ($request->get('mailing_lists')) {
            $campaign->mailingLists()->sync($request->input('mailing_lists'));
        }

        notify()->flash($campaign->name, 'success', [
            'timer' => 2000,
            'text' => trans('general.success.create'),
        ]);

        return redirect()->route('campaigns.show', $campaign);
    }

    /**
     * @param CampaignUpdateRequest $request
     * @param Campaign $campaign
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(CampaignUpdateRequest $request, Campaign $campaign)
    {
        $this->authorize('update', $campaign);

        $campaign->update($request->except('mailing_lists'));

        if ($request->get('mailing_lists')) {
            $campaign->mailingLists()->sync($request->input('mailing_lists'));
        }

        notify()->flash($campaign->name, 'success', [
            'timer' => 2000,
            'text' => trans('general.success.update'),
        ]);

        return redirect()->route('campaigns.show', $campaign);
    }

    /**
     * @param Campaign $campaign
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function send(Campaign $campaign)
    {
        $this->authorize('send', $campaign);

        $campaign->load('template', 'mailingLists.subscriptions');

        $this->dispatch(new SendCampaign(auth()->user(), $campaign, $campaign->template));

        notify()->flash(trans('general.woohoo'), 'success', [
            'timer' => 3500,
            'text' => trans('campaigns.send.success', ['name' => $campaign->name, 'subscribers' => $campaign->getSubscriptions()->count()]),
        ]);

        return redirect()->route('campaigns.index');
    }

    /**
     * @param Campaign $campaign
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete(Campaign $campaign)
    {
        $this->authorize('delete', $campaign);

        $campaign->delete();

        notify()->flash($campaign->name, 'success', [
            'timer' => 2000,
            'text' => trans('general.success.delete'),
        ]);

        return redirect()->route('campaigns.index');
    }

    /**
     * @param Campaign $campaign
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function export(Campaign $campaign)
    {
        $this->authorize('export', $campaign);

        $subscriptions = $campaign->getSubscriptions();

        Excel::create('Subscriptions-'.$campaign->name, function ($excel) use ($subscriptions) {
            $excel->sheet('Subscriptions', function ($sheet) use ($subscriptions) {
                $sheet->fromArray($subscriptions);
            });
        })->export('csv');
    }
}
