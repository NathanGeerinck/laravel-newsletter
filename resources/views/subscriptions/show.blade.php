@extends('layouts.app')

@section('title', 'Subscription: ' . $subscription->email)

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
                <table class="table">
                    <tbody>
                    <tr>
                        <th style="width:20%">Email</th>
                        <td>{{ $subscription->email }}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{!! $subscription->name !!}</td>
                    </tr>
                    <tr>
                        <th>Country</th>
                        <td>{!! ($subscription->country) ? countries($subscription->country) : '<i>No country selected</i>' !!}</td>
                    </tr>
                    {{--<tr>--}}
                        {{--<th>Language</th>--}}
                        {{--<td>{{ ($subscription->language) ? $subscription->languages : '<i>No language selected</i>' }}</td>--}}
                    {{--</tr>--}}
                    <tr>
                        <th>Created at</th>
                        <td><code>{{ $subscription->created_at }}</code></td>
                    </tr>
                    <tr>
                        <th>Updated at</th>
                        <td><code>{{ $subscription->updated_at }}</code></td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            {!! Form::open(['route' => ['subscriptions.delete', $subscription], 'method' => 'DELETE']) !!}
                            <div class="btn-group">
                                <a href="{{ route('subscriptions.edit', $subscription) }}" type="button" class="btn btn-default">Edit</a>
                                <a href="{{ route('subscriptions.clone', $subscription) }}" type="button" class="btn btn-default">Clone</a>
                                <a class="btn btn-default" type="button" onclick="deleteEntity(this, '{{ addslashes($subscription->email) }}')" data-toggle="tooltip" title="Delete {{ addslashes($subscription->email) }}"><i class="fa fa-times text-danger"></i></a>
                            </div>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection