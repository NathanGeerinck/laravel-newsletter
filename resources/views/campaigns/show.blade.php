@extends('layouts.app')

@section('title', trans('campaigns.show') . ': ' . $campaign->name)

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
                <table class="table">
                    <tbody>
                    <tr>
                        <th>{{ trans('general.name') }}</th>
                        <td>{{ $campaign->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('general.subject') }}</th>
                        <td>{!! $campaign->subject !!}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('general.lists') }}</th>
                        <td>
                            @foreach($campaign->mailingLists as $list)
                                <span class="label label-info">{{ $list->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>{{ trans('general.recipients') }}</th>
                        <td>
                            {{ $subscriptions->count() }}
                        </td>
                    </tr>
                    <tr>
                        <th>{{ trans('general.template') }}</th>
                        <td>{{ $campaign->template->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('general.created_at') }}</th>
                        <td><code>{{ $campaign->created_at }}</code></td>
                    </tr>
                    <tr>
                        <th>{{ trans('general.updated_at') }}</th>
                        <td><code>{{ $campaign->updated_at }}</code></td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            {!! Form::open(['route' => ['campaigns.delete', $campaign], 'method' => 'DELETE']) !!}
                            <div class="btn-group">
                                <a @if($campaign->send == 1) disabled @endif href="{{ route('campaigns.send', $campaign) }}" type="button" class="btn btn-default">{{ trans('general.send') }}</a>
                                <a @if($campaign->send == 1) disabled @endif href="{{ route('templates.preview', $campaign) }}" type="button" class="btn btn-default">{{ trans('general.preview') }}</a>
                                <a @if($campaign->send == 1) disabled @endif href="{{ route('campaigns.edit', $campaign) }}" type="button" class="btn btn-default">{{ trans('general.edit') }}</a>
                                <a href="{{ route('campaigns.clone', $campaign) }}" type="button" class="btn btn-default">{{ trans('general.clone') }}</a>
                                <a href="{{ route('campaigns.export', $campaign) }}" type="button" class="btn btn-default">{{ trans('general.export') }}</a>
                                <a class="btn btn-default" type="button" onclick="deleteEntity(this, '{{ addslashes($campaign->name) }}')" data-toggle="tooltip" title="{{ trans('general.delete') }} {{ addslashes($campaign->name) }}"><i class="fa fa-times text-danger"></i></a>
                            </div>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @if($campaign->send == 1)
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('campaigns.stats') }}</div>
                <div class="panel-body">

                </div>
            </div>
        @endif
    </div>
@endsection