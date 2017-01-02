<?php

namespace App\Http\Controllers;

use App\Http\Requests\CampaignCreateRequest;
use App\Http\Requests\CampaignUpdateRequest;
use App\Models\Campaign;
use App\Models\MailingList;
use App\Models\Subscription;
use App\Models\Template;
use Illuminate\Http\Request;

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
        abort_if($campaign->send, 404);

        $campaign->load('template', 'mailingLists');

        $subscriptions = array();

        foreach($campaign->mailingLists as $mailingList){
            $subscriptions[] = Subscription::where('mailing_list_id', $mailingList->id)->count();
        }

        return view('campaigns.show', compact('campaign', 'mailingLists', 'subscriptions'));
    }

    public function new(Campaign $campaign)
    {
        if(request()->is('campaigns/clone*')){
            $campaign->load('mailingLists');

            $mailingLists_arr = array();

            foreach ($campaign->mailingLists as $mailingList) {
                $mailingLists_arr[] = $mailingList['id'];
            }
        } else {
            $mailingLists_arr = null;
        }
        $lists = MailingList::get(['name', 'id'])->pluck('name', 'id');
        $templates = Template::get(['name', 'id'])->pluck('name', 'id');

        return view('campaigns.new', compact('campaign', 'lists', 'templates', 'mailingLists_arr'));
    }

    public function edit(Campaign $campaign)
    {
        abort_if($campaign->send, 404);

        $campaign->load('mailingLists');

        $lists = MailingList::get(['name', 'id'])->pluck('name', 'id');
        $templates = Template::get(['name', 'id'])->pluck('name', 'id');

        $mailingLists_arr = array();

        foreach ($campaign->mailingLists as $mailingList) {
            $mailingLists_arr[] = $mailingList['id'];
        }

        return view('campaigns.edit', compact('campaign', 'lists', 'templates', 'mailingLists_arr'));
    }

    public function preSend(Campaign $campaign)
    {
        abort_if($campaign->send, 404);

        $campaign->load('template', 'mailingLists');

        $subscriptions = array();

        foreach($campaign->mailingLists as $mailingList){
            $subscriptions[] = Subscription::where('mailing_list_id', $mailingList->id)->count();
        }

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
        dd($campaign);

        dd($campaign->update($request->except('mailing_lists')));

//        if($request->get('mailing_lists')){
//            $campaign->mailingLists()->sync($request->input('mailing_lists'));
//        }

        return redirect()->route('campaigns.show', $campaign)->withSuccess('Campaign: <i>' . $campaign->name . '</i> successfully updated!');
    }

    public function send(Request $request, Campaign $campaign)
    {

    }
}
