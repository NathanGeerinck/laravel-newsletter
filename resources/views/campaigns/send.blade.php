@extends('layouts.app')

@section('title', trans('campaigns.send') . ': ' . $campaign->name)

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                @yield('title')
                <div class="pull-right">
                    <div class="btn-group btn-group-xs">
                        <a href="{{ route('campaigns.index') }}" type="button" class="btn btn-default">{{ trans('general.back') }}</a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="alert alert-info" role="alert">{!! trans('campaigns.send.message', ['count' => $subscriptions->count()]) !!}</div>
                {{ Form::open(['route' => ['campaigns.send', $campaign]]) }}
                    {!! Form::submit(trans('campaigns.send'), ['class' => 'btn btn-default btn-lg btn-']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection