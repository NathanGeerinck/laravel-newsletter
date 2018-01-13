<?php

namespace App\Http\Controllers;

use App\Jobs\ImportSubscriptions;
use App\Models\MailingList;
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
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(MailingList $list)
    {
        $this->authorize('view', $list);

        $list->load('subscriptions', 'campaigns');

        return view('lists.show', compact('list'));
    }

    /**
     * @param MailingList $list
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(MailingList $list)
    {
        $this->authorize('update', $list);

        return view('lists.edit', compact('list'));
    }

    /**
     * @param MailingList $list
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function new(MailingList $list)
    {
        $this->authorize('create', $list);

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
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(MailingListUpdateRequest $request, MailingList $list)
    {
        $this->authorize('update', $list);

        $list->update($request->all());

        notify()->flash($list->name, 'success', [
            'timer' => 2000,
            'text' => trans('general.success.update'),
        ]);

        return redirect()->route('lists.show', $list);
    }

    /**
     * @param MailingList $list
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function delete(MailingList $list)
    {
        $this->authorize('delete', $list);

        $list->delete();

        notify()->flash($list->name, 'success', [
            'timer' => 2000,
            'text' => trans('general.success.delete'),
        ]);

        return redirect()->route('lists.index');
    }

    /**
     * @param MailingList $list
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function export(MailingList $list)
    {
        $this->authorize('export', $list);

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
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function import(Request $request, MailingList $list)
    {
        $this->authorize('import', $list);

        if ($request->file('file')->isValid()) {
            $file = $request->file('file')->getRealPath();

            $results = Excel::load($file)->toArray();

            $this->dispatch(new ImportSubscriptions($request->user(), $list, $results));

            notify()->flash('Wohoo!', 'success', [
                'timer' => 2000,
                'text' => trans('general.success.import'),
            ]);

            return redirect()->route('lists.show', $list);
        }
    }
}