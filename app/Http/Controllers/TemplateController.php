<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;
use App\Http\Requests\TemplateCreateRequest;
use App\Http\Requests\TemplateUpdateRequest;

/**
 * Class TemplateController.
 */
class TemplateController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $templates = Template::filter($request->all())
            ->paginateFilter(15, ['id', 'name']);

        return view('templates.index', compact('templates'));
    }

    /**
     * @param Template $template
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Template $template)
    {
        $this->authorize('view', $template);

        return view('templates.show', compact('template'));
    }

    /**
     * @param Template $template
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function new(Template $template)
    {
        return view('templates.new', compact('template'));
    }

    /**
     * @param Template $template
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Template $template)
    {
        $this->authorize('update', $template);

        return view('templates.edit', compact('template'));
    }

    /**
     * @param Template $template
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function preview(Template $template)
    {
        return view('templates.preview', compact('template'));
    }

    /**
     * @param TemplateCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(TemplateCreateRequest $request)
    {
        $template = auth()->user()->template()->create([
            'name' => $request->input('name'),
            'content' => $request->input('content'),
        ]);

        notify()->flash($template->name, 'success', [
            'timer' => 2000,
            'text' => trans('general.success.create'),
        ]);

        return redirect()->route('templates.show', $template);
    }

    /**
     * @param TemplateUpdateRequest $request
     * @param Template $template
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(TemplateUpdateRequest $request, Template $template)
    {
        $this->authorize('update', $template);

        $template->update([
            'name' => $request->input('name'),
            'content' => $request->input('content'),
        ]);

        notify()->flash($template->name, 'success', [
            'timer' => 2000,
            'text' => trans('general.success.update'),
        ]);

        return redirect()->route('templates.show', $template);
    }

    /**
     * @param Template $template
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function delete(Template $template)
    {
        $this->authorize('delete', $template);

        $template->delete();

        notify()->flash($template->name, 'success', [
            'timer' => 2000,
            'text' => trans('general.success.delete'),
        ]);

        return redirect()->route('templates.index');
    }
}
