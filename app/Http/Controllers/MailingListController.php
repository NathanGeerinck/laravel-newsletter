<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailingListCreateRequest;
use App\Http\Requests\MailingListUpdateRequest;
use App\Models\MailingList;
use Illuminate\Http\Request;

class MailingListController extends Controller
{
    public function index(Request $request)
    {
        $lists = MailingList::filter($request->all())
            ->with('subscriptions')
            ->paginateFilter(15, ['id', 'name', 'public']);

        return view('lists.index', compact('lists'));
    }

    public function show(MailingList $list)
    {
        $list->load('subscriptions', 'campaigns');

        return view('lists.show', compact('list'));
    }

    public function edit(MailingList $list)
    {
        return view('lists.edit', compact('list'));
    }

    public function new(MailingList $list)
    {
        return view('lists.new', compact('list'));
    }

    public function create(MailingListCreateRequest $request)
    {
        $list = auth()->user()->mailingList()->create($request->all());

        return redirect()->route('lists.show', $list)->withSuccess('List: ' . $list->name . ' successfully created!');
    }

    public function update(MailingListUpdateRequest $request, MailingList $list)
    {
        $list->update($request->all());

        return redirect()->route('lists.show', $list)->withSuccess('List: <i>' . $list->name . '</i> successfully updated!');
    }

    public function delete(MailingList $list)
    {
        $list->delete();

        return redirect()->route('lists.index')->withSuccess('List: <i>' . $list->name . '</i> successfully deleted!');
    }
}