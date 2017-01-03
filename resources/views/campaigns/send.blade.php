@extends('layouts.app')

@section('title', 'Campaign: ' . $campaign->name)

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                @yield('title')
                <div class="pull-right">
                    <div class="btn-group btn-group-xs">
                        <a href="{{ route('campaigns.index') }}" type="button" class="btn btn-default">Back to overview</a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="alert alert-info" role="alert">You're sending this campaign to <b>{{ $subscriptions->count() }}</b> recipients</div>
                {{ Form::open(['route' => ['campaigns.send', $campaign]]) }}
                    {!! Form::submit('Send campaign', ['class' => 'btn btn-default btn-lg btn-']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection