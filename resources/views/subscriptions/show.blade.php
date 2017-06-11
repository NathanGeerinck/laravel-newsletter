@extends('layouts.app')

@section('title', trans('subscriptions.show') . ': ' . $subscription->email)

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                @yield('title')
                <div class="pull-right">
                    <div class="btn-group btn-group-xs">
                        <a href="{{ route('subscriptions.index') }}" type="button" class="btn btn-default">{{ trans('general.back') }}</a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tbody>
                    <tr>
                        <th style="width:20%">{{ trans('general.email') }}</th>
                        <td>{{ $subscription->email }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('general.name') }}</th>
                        <td>{!! $subscription->name !!}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('general.country') }}</th>
                        <td>{!! ($subscription->country) ? countries($subscription->country) : '<i>' . trans('subscriptions.country.none') .'</i>' !!}</td>
                    </tr>
                    {{--<tr>--}}
                        {{--<th>Language</th>--}}
                        {{--<td>{{ ($subscription->language) ? $subscription->languages : '<i>No language selected</i>' }}</td>--}}
                    {{--</tr>--}}
                    <tr>
                        <th>{{ trans('general.created_at') }}</th>
                        <td><code>{{ $subscription->created_at }}</code></td>
                    </tr>
                    <tr>
                        <th>{{ trans('general.updated_at') }}</th>
                        <td><code>{{ $subscription->updated_at }}</code></td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            {!! Form::open(['route' => ['subscriptions.delete', $subscription], 'method' => 'DELETE']) !!}
                            <div class="btn-group">
                                <a href="{{ route('subscriptions.edit', $subscription) }}" type="button" class="btn btn-default">{{ trans('general.edit') }}</a>
                                <a href="{{ route('subscriptions.clone', $subscription) }}" type="button" class="btn btn-default">{{ trans('general.clone') }}</a>
                                <a class="btn btn-default" type="button" onclick="deleteEntity(this, '{{ addslashes($subscription->email) }}')" data-toggle="tooltip" title="{{ trans('general.delete') }} {{ addslashes($subscription->email) }}"><i class="fa fa-times text-danger"></i></a>
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