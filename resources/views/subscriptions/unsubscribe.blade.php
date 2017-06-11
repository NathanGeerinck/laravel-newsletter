@extends('layouts.app')

@section('title', trans('subscriptions.unsubscribe'))

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                @yield('title')
            </div>
            <div class="panel-body">
                {!! Form::open(['route' => ['subscriptions.unsubscribe', $subscription], 'method' => 'DELETE']) !!}
                <div class="alert alert-warning" role="alert">{{ trans('subscriptions.confirm.unsubscribe') }} <a class="btn btn-default btn-sm pull-right" type="button" onclick="deleteSubscription(this)" data-toggle="tooltip" title="{{ trans('subscriptions.unsubscribe') }}">{{ trans('subscriptions.unsubscribe') }}</a></div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection