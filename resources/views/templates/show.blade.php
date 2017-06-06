@extends('layouts.app')

@section('title', trans('templates.show') . ': ' . $template->name)

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                @yield('title')
                <div class="pull-right">
                    <div class="btn-group btn-group-xs">
                        <a href="{{ route('templates.index') }}" type="button" class="btn btn-default">{{ trans('general.back') }}</a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <th style="width:20%">{{ trans('general.name') }}</th>
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
                                {!! Form::open(['route' => ['templates.delete', $template], 'method' => 'DELETE']) !!}
                                <div class="btn-group">
                                    <a href="{{ route('templates.preview', $template) }}" target="_blank" type="button" class="btn btn-default">{{ trans('general.preview') }}</a>
                                    <a href="{{ route('templates.edit', $template) }}" type="button" class="btn btn-default">{{ trans('general.edit') }}</a>
                                    <a href="{{ route('templates.clone', $template) }}" type="button" class="btn btn-default">{{ trans('general.clone') }}</a>
                                    <a class="btn btn-default" type="button" onclick="deleteEntity(this, '{{ addslashes($template->name) }}')" data-toggle="tooltip" title="Delete {{ addslashes($template->name) }}"><i class="fa fa-times text-danger"></i></a>
                                </div>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection