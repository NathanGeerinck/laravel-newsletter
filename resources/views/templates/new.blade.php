@extends('layouts.app')

@section('title', trans('templates.new'))

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
                {!! Form::model((request()->is('templates/clone*')) ? $template : 'null', ['route' => ['templates.create']]) !!}

                @include('forms.templates')

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection