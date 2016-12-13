@extends('layouts.app')

@section('title', 'New subscription')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                @yield('title')
                <div class="pull-right">
                    <div class="btn-group btn-group-xs">
                        <a href="{{ route('subscriptions.index') }}" type="button" class="btn btn-default">Back to overview</a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
            </div>
        </div>
    </div>
@endsection