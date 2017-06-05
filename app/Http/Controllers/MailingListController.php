<?php

namespace App\Http\Controllers;

use App\Jobs\ImportSubscriptions;
use App\Models\MailingList;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Requests\MailingListUpdateRequest;
use App\Http\Requests\MailingListCreateRequest;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class MailingListController
 * @package App\Http\Controllers
 */
class MailingListController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $lists = MailingList::filter($request->all())
            ->with('subscriptions')
            ->paginateFilter(15, ['id', 'name', 'public']);

        return view('lists.index', compact('lists'));
    }

    /**
     * @param MailingList $list
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(MailingList $list)
    {
        $list->load('subscriptions', 'campaigns');

        return view('lists.show', compact('list'));
    }

    /**
     * @param MailingList $list
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(MailingList $list)
    {
        return view('lists.edit', compact('list'));
    }

    /**
     * @param MailingList $list
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function new(MailingList $list)
    {
        return view('lists.new', compact('list'));
    }

    /**
     * @param MailingList $list
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function preImport(MailingList $list)
    {
        return view('lists.import', compact('list'));
    }

    /**
     * @param MailingListCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(MailingListCreateRequest $request)
    {
        $list = auth()->user()->mailingList()->create($request->all());

        notify()->flash($list->name, 'success', [
            'timer' => 2000,
            'text' => 'Successfully created!',
        ]);

        return redirect()->route('lists.show', $list);
    }

    /**
     * @param MailingListUpdateRequest $request
     * @param MailingList $list
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MailingListUpdateRequest $request, MailingList $list)
    {
        $list->update($request->all());

        notify()->flash($list->name, 'success', [
            'timer' => 2000,
            'text' => 'Successfully updated!',
        ]);

        return redirect()->route('lists.show', $list);
    }

    /**
     * @param MailingList $list
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(MailingList $list)
    {
        $list->delete();

        notify()->flash($list->name, 'success', [
            'timer' => 2000,
            'text' => 'Successfully deleted!',
        ]);

        return redirect()->route('lists.index');
    }

    /**
     * @param MailingList $list
     */
    public function export(MailingList $list)
    {
        $subscriptions = $list->subscriptions;

        Excel::create('Subscriptions-' . $list->name, function ($excel) use ($subscriptions) {
            $excel->sheet('Subscriptions', function ($sheet) use ($subscriptions) {
                $sheet->fromArray($subscriptions);
            });
        })->export('csv');
    }

    /**
     * @param Request $request
     * @param MailingList $list
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(Request $request, MailingList $list)
    {
        if ($request->file('file')->isValid()) {
            $file = $request->file('file')->getRealPath();

            $results = Excel::load($file)->toArray();

            $this->dispatch(new ImportSubscriptions($list, $results));

            notify()->flash('Wohoo!', 'success', [
                'timer' => 2000,
                'text' => 'Import successfully!',
            ]);

            return redirect()->route('lists.show', $list);
        }
    }
}
