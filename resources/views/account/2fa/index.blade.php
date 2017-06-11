@extends('layouts.app')

@section('title', trans('account.account') . ': ' . trans('account.2fa.name'))

@section('content')

    <div class="container">
        @include('account.parts.navigation')
        <br>
        <br>
        <div class="panel panel-default">
            <div class="panel-heading">@yield('title')</div>

            <div class="panel-body">
                @if($account->google2fa_secret == false)
                {!! Form::model($account, ['route' => ['account.2fa.enable']]) !!}

                <div class="alert alert-warning" role="alert">{{ trans('account.2fa.disabled') }} {!! Form::submit(trans('account.2fa.enable'), ['class' => 'btn btn-default btn-sm pull-right']) !!}</div>

                {!! Form::close() !!}
                @else
                {!! Form::model($account, ['route' => ['account.2fa.disable']]) !!}

                <div class="alert alert-success" role="alert">{{ trans('account.2fa.enabled') }} {!! Form::submit(trans('account.2fa.disable'), ['class' => 'btn btn-default btn-sm pull-right']) !!}</div>

                {!! Form::close() !!}

                @endif
            </div>
        </div>
    </div>

@endsection
