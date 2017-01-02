@extends('layouts.app')

@section('title', 'Settings: Mail')

@section('content')
    <div class="container">
        @include('settings.parts.navigation')
        <br>
        <br>
        <div class="panel panel-default">
            <div class="panel-heading">@yield('title')</div>

            <div class="panel-body">
                {!! Form::model(null, ['route' => ['settings.mail.update']]) !!}

                @include('forms.settings.mail')

                {!! Form::close() !!}

            </div>

        </div>
    </div>
@endsection