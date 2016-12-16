@extends('layouts.app')

@section('title', 'Edit template: ' . $template->name)

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
            {!! Form::model($template, ['route' => ['templates.update', $template]]) !!}

            @include('forms.templates')

            {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection