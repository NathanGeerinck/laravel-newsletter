<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Template;
use App\Jobs\SendCampaign;
use App\Models\MailingList;
use Illuminate\Http\Request;
use App\Http\Requests\CampaignCreateRequest;
use App\Http\Requests\CampaignUpdateRequest;

class CampaignController extends Controller
{
    public function index(Request $request)
    {
        $campaigns = Campaign::filter($request->all())
            ->with('mailingLists')
            ->paginateFilter(15, ['id', 'name', 'send']);

        return view('campaigns.index', compact('campaigns'));
    }

    public function show(Campaign $campaign)
    {
        $campaign->load('template', 'mailingLists.subscriptions');

        $subscriptions = $campaign->getSubscriptions();

        return view('campaigns.show', compact('campaign', 'mailingLists', 'subscriptions'));
    }

    public function new(Campaign $campaign)
    {
        if(request()->is('campaigns/clone*')){
            $campaign->load('mailingLists');

            $mailingLists = $campaign->getMailingList()->pluck('id')->toArray();
        }

        $lists = MailingList::get(['name', 'id'])->pluck('name', 'id');
        $templates = Template::get(['name', 'id'])->pluck('name', 'id');

        return view('campaigns.new', compact('campaign', 'lists', 'templates', 'mailingLists'));
    }

    public function edit(Campaign $campaign)
    {
        abort_if($campaign->send, 404);

        $campaign->load('mailingLists');

        $lists = MailingList::get(['name', 'id'])->pluck('name', 'id');
        $templates = Template::get(['name', 'id'])->pluck('name', 'id');

        $mailingLists = $campaign->getMailingList()->pluck('id')->toArray();

        return view('campaigns.edit', compact('campaign', 'lists', 'templates', 'mailingLists'));
    }

    public function preSend(Campaign $campaign)
    {
        abort_if($campaign->send, 404);

        $campaign->load('template', 'mailingLists.subscriptions');

        $subscriptions = $campaign->getSubscriptions();

        return view('campaigns.send', compact('campaign', 'mailingLists', 'subscriptions'));
    }

    public function create(CampaignCreateRequest $request)
    {
        $campaign = auth()->user()->campaigns()->create($request->all());

        if($request->get('mailing_lists')){
            $campaign->mailingLists()->sync($request->input('mailing_lists'));
        }

        return redirect()->route('campaigns.show', $campaign)->withSuccess('Campaign: <i>' . $campaign->name . '</i> successfully created!');
    }

    public function update(CampaignUpdateRequest $request, Campaign $campaign)
    {
        $campaign->update($request->except('mailing_lists'));

        if($request->get('mailing_lists')){
            $campaign->mailingLists()->sync($request->input('mailing_lists'));
        }

        return redirect()->route('campaigns.show', $campaign)->withSuccess('Campaign: <i>' . $campaign->name . '</i> successfully updated!');
    }

    public function send(Campaign $campaign)
    {
        $campaign->load('template', 'mailingLists.subscriptions');
        $subscriptions = $campaign->getSubscriptions();

        $this->dispatch(new SendCampaign($subscriptions, $campaign, $campaign->template));

        return redirect()->route('campaigns.index')->withSuccess('Campaign: <i>' . $campaign->name . '</i> successfully send to ' . $subscriptions->count() . ' recipients!');
    }

    public function delete(Campaign $campaign)
    {
        $campaign->delete();

        return redirect()->route('campaigns.index')->withSuccess('Campaign: <i>' . $campaign->name . '</i> successfully deleted!');
    }
}