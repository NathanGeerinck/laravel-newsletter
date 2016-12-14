<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailingListUpdateRequest;
use App\Models\MailingList;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function index()
    {
        $lists = MailingList::orderBy('id', 'desc')
            ->paginate(15, ['id', 'name']);

        return view('lists.index', compact('lists'));
    }

    public function show(MailingList $list)
    {
        return view('lists.show', compact('list'));
    }

    public function edit(MailingList $list)
    {
        return view('lists.edit', compact('list'));
    }

    public function new()
    {
        return view('lists.new');
    }

    public function update(MailingListUpdateRequest $request, MailingList $list)
    {
        $list->update($request->all());

        return redirect()->route('lists.show', $list->id);
    }
}
