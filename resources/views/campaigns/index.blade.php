@extends('layouts.app')

@section('title', 'Campaigns')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                @yield('title')
                <div class="pull-right">
                    <div class="btn-group btn-group-xs">
                        <a href="{{ route('campaigns.new') }}" type="button" class="btn btn-default">Create campaign</a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
            </div>
        </div>
    </div>
@endsection