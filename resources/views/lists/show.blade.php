@extends('layouts.app')

@section('title', trans('lists.show') . ' ' . $list->name)

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                @yield('title')
                <div class="pull-right">
                    <div class="btn-group btn-group-xs">
                        <a href="{{ route('lists.index') }}" type="button" class="btn btn-default">{{ trans('general.back') }}</a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <th style="width:20%">{{ trans('general.name') }}</th>
                            <td>{{ $list->name }}</td>
                        </tr>
                        <tr>
                            <th>{{ trans('general.description') }}</th>
                            <td>{!! $list->description !!}</td>
                        </tr>
                        <tr>
                            <th>{{ trans('general.subscriptions') }}</th>
                            <td>{{ $list->subscriptions->count() }}</td>
                        </tr>
                        <tr>
                            <th>{{ trans('general.campaigns') }}</th>
                            <td>
                                @foreach($list->campaigns as $campaign)
                                    <span class="label label-info">{{ $campaign->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>{{ trans('general.created_at') }}</th>
                            <td><code>{{ $list->created_at }}</code></td>
                        </tr>
                        <tr>
                            <th>{{ trans('general.updated_at') }}</th>
                            <td><code>{{ $list->updated_at }}</code></td>
                        </tr>
                        {{--@if($list->public == true)--}}
                        {{--<tr>--}}
                            {{--<th>Public link</th>--}}
                            {{--<td><input class="form-control" value="{{ route('subscriptions.subscribe', $list) }}"></td>--}}
                        {{--</tr>--}}
                        {{--@endif--}}
                        <tr>
                            <th></th>
                            <td>
                                {!! Form::open(['route' => ['lists.delete', $list], 'method' => 'DELETE']) !!}
                                <div class="btn-group">
                                    <a href="{{ route('lists.edit', $list) }}" type="button" class="btn btn-default">{{ trans('general.edit') }}</a>
                                    <a href="{{ route('lists.clone', $list) }}" type="button" class="btn btn-default">{{ trans('general.clone') }}</a>
                                    <a href="{{ route('lists.preimport', $list) }}" type="button" class="btn btn-default">{{ trans('general.import') }}</a>
                                    <a href="{{ route('lists.export', $list) }}" type="button" class="btn btn-default">{{ trans('general.export') }}</a>
                                    <a class="btn btn-default" type="button" onclick="deleteEntity(this, '{{ addslashes($list->name) }}')" data-toggle="tooltip" title="{{ trans('general.delete') }} {{ addslashes($list->name) }}"><i class="fa fa-times text-danger"></i></a>
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