@extends('layouts.app')

@section('title', 'Subscriptions (' . $subscriptions->count() . ')')

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
                <table class="table" id="exceptions">
                    <thead>
                    <tr>
                        <th class="text-center" style="">ID</th>
                        <th style="">E-mail</th>
                        <th style="">Name</th>
                        <th style="">Country</th>
                        <th style="">Language</th>
                        <th style="">List</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($subscriptions as $subscription)
                        <tr>
                            <td class="text-center">{{ $subscription->id }}</td>
                            <td>{{ $subscription->email }}</td>
                            <td>{{ $subscription->name }}</td>
                            <td>{{ $subscription->country }}</td>
                            <td>{{ $subscription->language }}</td>
                            <td>{{ $subscription->mailingList()->count() }}</td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group" aria-label="">
                                    {{--<a href="{{ route('lists.show', $subscription->id) }}" class="btn btn-default"><i class="fa fa-eye"></i></a>--}}
                                    {{--<a href="{{ route('lists.edit', $subscription->id) }}" class="btn btn-default"><i class="fa fa-pencil"></i></a>--}}
                                    <a class="btn btn-default"><i class="fa fa-times text-danger"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection