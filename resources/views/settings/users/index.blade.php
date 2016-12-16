@extends('layouts.app')

@section('title', 'Settings: users')

@section('content')
    <div class="container">
        @include('settings.parts.navigation')
        <br>
        <br>
        <div class="panel panel-default">
            <div class="panel-heading">@yield('title')</div>

            <div class="panel-body">
                You are logged in!
            </div>
        </div>
    </div>
@endsection