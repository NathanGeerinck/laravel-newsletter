<?php

namespace App\Http\Controllers;

use App\Models\MailingList;
use Illuminate\Http\Request;
use App\Http\Requests\MailingListUpdateRequest;
use App\Http\Requests\MailingListCreateRequest;
use Maatwebsite\Excel\Facades\Excel;

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

        notify()->flash($list->name, 'success', [
            'timer' => 2000,
            'text' => 'Successfully created!',
        ]);

        return redirect()->route('lists.show', $list);
    }

    public function update(MailingListUpdateRequest $request, MailingList $list)
    {
        $list->update($request->all());

        notify()->flash($list->name, 'success', [
            'timer' => 2000,
            'text' => 'Successfully updated!',
        ]);

        return redirect()->route('lists.show', $list);
    }

    public function delete(MailingList $list)
    {
        $list->delete();

        notify()->flash($list->name, 'success', [
            'timer' => 2000,
            'text' => 'Successfully deleted!',
        ]);

        return redirect()->route('lists.index');
    }

    public function export(MailingList $list)
    {
        $subscriptions = $list->subscriptions;

        Excel::create('Subscriptions-' . $list->name, function ($excel) use ($subscriptions) {
            $excel->sheet('Subscriptions', function ($sheet) use ($subscriptions) {
                $sheet->fromArray($subscriptions);
            });
        })->export('csv');
    }
}