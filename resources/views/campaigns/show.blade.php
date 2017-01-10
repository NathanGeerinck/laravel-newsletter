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
                <table class="table">
                    <tbody>
                    <tr>
                        <th>Name</th>
                        <td>{{ $campaign->name }}</td>
                    </tr>
                    <tr>
                        <th>Subject</th>
                        <td>{!! $campaign->subject !!}</td>
                    </tr>
                    <tr>
                        <th>List(s)</th>
                        <td>
                            @foreach($campaign->mailingLists as $list)
                                <span class="label label-info">{{ $list->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>Recipients</th>
                        <td>
                            {{ $subscriptions->count() }}
                        </td>
                    </tr>
                    <tr>
                        <th>Template</th>
                        <td>{{ $campaign->template->name }}</td>
                    </tr>
                    <tr>
                        <th>Created at</th>
                        <td><code>{{ $campaign->created_at }}</code></td>
                    </tr>
                    <tr>
                        <th>Updated at</th>
                        <td><code>{{ $campaign->updated_at }}</code></td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            {!! Form::open(['route' => ['campaigns.delete', $campaign], 'method' => 'DELETE']) !!}
                            <div class="btn-group">
                                <a @if($campaign->send == 1) disabled @endif href="{{ route('campaigns.send', $campaign) }}" type="button" class="btn btn-default">Send</a>
                                <a @if($campaign->send == 1) disabled @endif href="{{ route('templates.preview', $campaign) }}" type="button" class="btn btn-default">Preview</a>
                                <a @if($campaign->send == 1) disabled @endif href="{{ route('campaigns.edit', $campaign) }}" type="button" class="btn btn-default">Edit</a>
                                <a href="{{ route('campaigns.clone', $campaign) }}" type="button" class="btn btn-default">Clone</a>
                                <a href="{{ route('campaigns.export', $campaign) }}" type="button" class="btn btn-default">Export</a>
                                <a class="btn btn-default" type="button" onclick="deleteEntity(this, '{{ addslashes($campaign->name) }}')" data-toggle="tooltip" title="Delete {{ addslashes($campaign->name) }}"><i class="fa fa-times text-danger"></i></a>
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