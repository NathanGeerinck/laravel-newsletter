<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Template;
use App\Jobs\SendCampaign;
use App\Models\MailingList;
use Illuminate\Http\Request;
use App\Http\Requests\CampaignCreateRequest;
use App\Http\Requests\CampaignUpdateRequest;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class CampaignController
 * @package App\Http\Controllers
 */
class CampaignController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $campaigns = Campaign::filter($request->all())
            ->with('mailingLists')
            ->paginateFilter(15, ['id', 'name', 'send']);

        return view('campaigns.index', compact('campaigns'));
    }

    /**
     * @param Campaign $campaign
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Campaign $campaign)
    {
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
     */
    public function edit(Campaign $campaign)
    {
        abort_if($campaign->send, 404);

        $campaign->load('mailingLists');

        $lists = MailingList::get(['name', 'id'])->pluck('name', 'id');
        $templates = Template::get(['name', 'id'])->pluck('name', 'id');

        $mailingLists = $campaign->getMailingList()->pluck('id')->toArray();

        return view('campaigns.edit', compact('campaign', 'lists', 'templates', 'mailingLists'));
    }

    /**
     * @param Campaign $campaign
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function preSend(Campaign $campaign)
    {
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
            'text' => 'Successfully created!',
        ]);

        return redirect()->route('campaigns.show', $campaign);
    }

    /**
     * @param CampaignUpdateRequest $request
     * @param Campaign $campaign
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CampaignUpdateRequest $request, Campaign $campaign)
    {
        $campaign->update($request->except('mailing_lists'));

        if ($request->get('mailing_lists')) {
            $campaign->mailingLists()->sync($request->input('mailing_lists'));
        }

        notify()->flash($campaign->name, 'success', [
            'timer' => 2000,
            'text' => 'Successfully updated!',
        ]);

        return redirect()->route('campaigns.show', $campaign);
    }

    /**
     * @param Campaign $campaign
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(Campaign $campaign)
    {
        $campaign->load('template', 'mailingLists.subscriptions');
        $subscriptions = $campaign->getSubscriptions();

        $this->dispatch(new SendCampaign($subscriptions, $campaign, $campaign->template));

        notify()->flash('Woohooo!', 'success', [
            'timer' => 3500,
            'text' => 'Successfully send ' . $campaign->name . ' to ' . $subscriptions->count() . ' recipients!',
        ]);

        return redirect()->route('campaigns.index');
    }

    /**
     * @param Campaign $campaign
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Campaign $campaign)
    {
        $campaign->delete();

        notify()->flash($campaign->name, 'success', [
            'timer' => 2000,
            'text' => 'Successfully deleted!',
        ]);

        return redirect()->route('campaigns.index');
    }

    /**
     * @param Campaign $campaign
     */
    public function export(Campaign $campaign)
    {
        $subscriptions = $campaign->getSubscriptions();

        Excel::create('Subscriptions-' . $campaign->name, function ($excel) use ($subscriptions) {
            $excel->sheet('Subscriptions', function ($sheet) use ($subscriptions) {
                $sheet->fromArray($subscriptions);
            });
        })->export('csv');
    }
}
