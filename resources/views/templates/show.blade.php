@extends('layouts.app')

@section('title', 'Template: ' . $template->name)

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                @yield('title')
                <div class="pull-right">
                    <div class="btn-group btn-group-xs">
                        <a href="{{ route('templates.index') }}" type="button" class="btn btn-default">Back to overview</a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <th style="width:20%">Name</th>
                            <td>{{ $template->name }}</td>
                        </tr>
                        <tr>
                            <th>Created at</th>
                            <td><code>{{ $template->created_at }}</code></td>
                        </tr>
                        <tr>
                            <th>Updated at</th>
                            <td><code>{{ $template->updated_at }}</code></td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('templates.preview', $template) }}" target="_blank" type="button" class="btn btn-default">Preview</a>
                                    <a href="{{ route('templates.edit', $template) }}" type="button" class="btn btn-default">Edit</a>
                                    <a href="{{ route('templates.clone', $template) }}" type="button" class="btn btn-default">Clone</a>
                                    <a href="" type="button" class="btn btn-default">Delete</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection