<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;
use App\Http\Requests\TemplateCreateRequest;
use App\Http\Requests\TemplateUpdateRequest;

class TemplateController extends Controller
{
    public function index(Request $request)
    {
        $templates = Template::filter($request->all())
            ->paginateFilter(15, ['id', 'name']);

        return view('templates.index', compact('templates'));
    }

    public function show(Template $template)
    {
        return view('templates.show', compact('template'));
    }

    public function new(Template $template)
    {
        return view('templates.new', compact('template'));
    }

    public function edit(Template $template)
    {
        return view('templates.edit', compact('template'));
    }

    public function preview(Template $template)
    {
        return view('templates.preview', compact('template'));
    }

    public function create(TemplateCreateRequest $request)
    {
        $template = auth()->user()->template()->create($request->all());

        return redirect()->route('templates.show', $template)->withSuccess('Template: <i>' . $template->name . '</i> successfully created!');
    }

    public function update(TemplateUpdateRequest $request, Template $template)
    {
        $template->update($request->all());

        return redirect()->route('templates.show', $template)->withSuccess('Template: <i>' . $template->name . '</i> successfully updated!');
    }

    public function delete(Template $template)
    {
        $template->delete();

        return redirect()->route('templates.index')->withSuccess('Template: <i>' . $template->name . '</i> successfully deleted!');
    }
}