@extends('layouts.app')

@section('title', trans('account.account') . ': ' . trans('account.password.name'))

@section('content')
    <div class="container">
        @include('account.parts.navigation')
        <br>
        <br>
        <div class="panel panel-default">
            <div class="panel-heading">@yield('title')</div>

            <div class="panel-body">
                {!! Form::model(null, ['route' => ['account.password.update']]) !!}

                @include('forms.account.password')

                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection