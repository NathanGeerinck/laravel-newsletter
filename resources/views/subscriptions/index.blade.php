@extends('layouts.app')

@section('title', 'Subscriptions')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                @yield('title')
                <div class="pull-right">
                    <div class="btn-group btn-group-xs">
                        <a href="{{ route('subscriptions.new') }}" type="button" class="btn btn-default">Add subscription</a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
            </div>
        </div>
    </div>
@endsection