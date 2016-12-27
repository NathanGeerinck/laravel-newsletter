<?php

namespace App\Http\Controllers;

use App\Http\Requests\CampaignCreateRequest;
use App\Http\Requests\CampaignUpdateRequest;
use App\Models\Campaign;
use App\Models\MailingList;
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
//        ($campaign->send == 1) ? abort(404) : null;

        $campaign->load('template', 'mailingLists');

        return view('campaigns.show', compact('campaign'));
    }

    public function new(Campaign $campaign)
    {
        $lists = MailingList::get(['name', 'id'])->pluck('name', 'id');
        $templates = Template::get(['name', 'id'])->pluck('name', 'id');

        return view('campaigns.new', compact('campaign', 'lists', 'templates'));
    }

    public function edit(Campaign $campaign)
    {
//        ($campaign->send == 1) ? abort(404) : null;

        $campaign->load('mailingLists');

        $lists = MailingList::get(['name', 'id'])->pluck('name', 'id');
        $templates = Template::get(['name', 'id'])->pluck('name', 'id');

        return view('campaigns.edit', compact('campaign', 'lists', 'templates', 'mailingLists'));
    }

    public function create(CampaignCreateRequest $request)
    {
        $campaign = auth()->user()->campaigns()->create($request->all());

        if($request->get('mailing_lists')){
            $campaign->mailingLists()->sync($request->input('mailing_lists'));
        }

        return redirect()->route('campaigns.show', $campaign)->withSuccess('Campaign: <i>' . $campaign->name . '</i> successfully created!');
    }

    public function update(Request $request, Campaign $campaign)
    {
        $campaign->update($request->all());

        if($request->get('mailing_lists')){
            $campaign->mailingLists()->sync($request->input('mailing_lists'));
        }

        return redirect()->route('campaigns.index');
    }
}
