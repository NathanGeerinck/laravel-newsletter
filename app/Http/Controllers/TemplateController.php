<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;
use App\Http\Requests\TemplateCreateRequest;
use App\Http\Requests\TemplateUpdateRequest;

/**
 * Class TemplateController
 * @package App\Http\Controllers
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
     */
    public function show(Template $template)
    {
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
     */
    public function edit(Template $template)
    {
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
            'content' => $request->input('editor'),
        ]);

        notify()->flash($template->name, 'success', [
            'timer' => 2000,
            'text' => 'Template successfully created!',
        ]);

        return redirect()->route('templates.show', $template);
    }

    /**
     * @param TemplateUpdateRequest $request
     * @param Template $template
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TemplateUpdateRequest $request, Template $template)
    {
        $template->update([
            'name' => $request->input('name'),
            'content' => $request->input('editor'),
        ]);

        notify()->flash($template->name, 'success', [
            'timer' => 2000,
            'text' => 'Template successfully updated!',
        ]);

        return redirect()->route('templates.show', $template);
    }

    /**
     * @param Template $template
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Template $template)
    {
        $template->delete();

        notify()->flash($template->name, 'success', [
            'timer' => 2000,
            'text' => 'Template successfully deleted!',
        ]);

        return redirect()->route('templates.index');
    }
}
