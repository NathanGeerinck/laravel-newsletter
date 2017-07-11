@extends('layouts.app')

@section('title', trans('subscriptions.index') . ' (' . $subscriptions->total() . ')')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                @yield('title')
                <div class="pull-right">
                    <div class="btn-group btn-group-xs">
                        <a href="{{ route('subscriptions.new') }}" type="button" class="btn btn-default">{{ trans('subscriptions.add') }}</a>
                        <a href="{{ route('subscriptions.export', 'csv') }}" type="button" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="{{ trans('subscriptions.export.csv') }}"><i class="fa fa-table" aria-hidden="true"></i></a>
                        <a href="{{ route('subscriptions.export', 'xlsx') }}" type="button" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="{{ trans('subscriptions.export.xlsx') }}"><i class="fa fa-file-excel-o" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                {!! Form::model(request()->all(), ['route' => 'subscriptions.filter', 'method' => 'get']) !!}
                <div class="col-xs-12 col-md-6 col-md-offset-3">
                    <div class="input-group">
                        {!! Form::text('filter', null, ['class' => 'form-control', 'placeholder' => trans('forms.search')]) !!}
                        <div class="input-group-btn">
                            {!! Form::submit(trans('forms.search'), ['class' => 'btn btn-default']) !!}
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
                <br><br>
                <table class="table">
                    <thead>
                    <tr>
                        <th class="text-center" style="">{{ trans('general.id') }}</th>
                        <th style="">{{ trans('general.email') }}</th>
                        <th style="">{{ trans('general.name') }}</th>
                        <th class="text-center">{{ trans('general.list') }}</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($subscriptions->count() == 0)

                    @endif
                    @foreach($subscriptions as $subscription)
                        <tr>
                            <td class="text-center">{{ $subscription->id }}</td>
                            <td>{{ $subscription->email }}</td>
                            <td>{{ $subscription->name }}</td>
                            <td class="text-center"><span class="label label-info">{{ $subscription->mailingList->name }}</span></td>
                            <td class="text-center">
                                {!! Form::open(['route' => ['subscriptions.delete', $subscription], 'method' => 'DELETE']) !!}
                                <div class="btn-group btn-group-sm" role="group" aria-label="">
                                    <a href="{{ route('subscriptions.show', $subscription) }}" class="btn btn-default"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('subscriptions.edit', $subscription) }}" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ route('subscriptions.clone', $subscription) }}" class="btn btn-default"><i class="fa fa-clone"></i></a>
                                    <a class="btn btn-default" type="button" onclick="deleteEntity(this, '{{ addslashes($subscription->email) }}')" data-toggle="tooltip" title="{{ trans('general.delete') }} {{ addslashes($subscription->email) }}"><i class="fa fa-times text-danger"></i></a>
                                </div>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    @if($subscriptions->count() == 0)
                        <tr>
                            <td class="text-center" colspan="5"><i>{{ trans('subscriptions.empty') }}</i></td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                <div class="text-center">{{ $subscriptions->links() }}</div>
            </div>
        </div>
    </div>
@endsection