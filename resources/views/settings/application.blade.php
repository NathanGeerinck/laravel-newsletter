@extends('layouts.app')

@section('title', 'Settings: Application')

@section('content')
    <div class="container">
        @include('settings.parts.navigation')
        <br>
        <br>
        <div class="panel panel-default">
            <div class="panel-heading">@yield('title')</div>

            <div class="panel-body">
                {!! Form::model(null, ['route' => ['settings.application.update']]) !!}

                @include('forms.settings.application')

                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection