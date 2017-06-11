@extends('layouts.app')

@section('title', trans('account.account') . ': ' . trans('account.general.name'))

@section('content')
    <div class="container">
        @include('account.parts.navigation')
        <br>
        <br>
        <div class="panel panel-default">
            <div class="panel-heading">@yield('title')</div>

            <div class="panel-body">
                {!! Form::model($account, ['route' => ['account.general.update']]) !!}

                @include('forms.account.general')

                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection