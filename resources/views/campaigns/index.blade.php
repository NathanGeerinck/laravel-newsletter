@extends('layouts.app')

@section('title', 'Campaigns (' . $campaigns->total() . ')')

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
                <div class="col-xs-12 col-md-6 col-md-offset-3">
                    {!! Form::model(request()->all(), ['route' => 'campaigns.filter', 'method' => 'get']) !!}
                    <div class="input-group">
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Search']) !!}
                        <div class="input-group-btn">
                            {!! Form::submit('Search', ['class' => 'btn btn-default']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                <br><br>
                <div class="table-responsive">
                    <table class="table" id="exceptions">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 15%">ID</th>
                            <th style="width: 50%;">Name</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($campaigns as $campaign)
                            <tr>
                                <td class="text-center">{{ $campaign->id }}</td>
                                <td>{{ $campaign->name }}</td>
                                <td class="text-center"><span class="label label-info"></span></td>
                                <td class="text-center">
                                    {!! Form::open(['route' => ['campaigns.delete', $campaign], 'method' => 'DELETE']) !!}
                                    <div class="btn-group btn-group-sm" role="group" aria-label="">
                                        <a @if($campaign->send == 1) disabled @endif href="{{ route('campaigns.presend', $campaign) }}" class="btn btn-default"><i class="fa fa-paper-plane-o"></i></a>
                                        <a href="{{ route('campaigns.show', $campaign) }}" class="btn btn-default"><i class="fa fa-eye"></i></a>
                                        <a @if($campaign->send == 1) disabled @endif href="{{ route('campaigns.edit', $campaign) }}" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                                        <a href="{{ route('campaigns.clone', $campaign) }}" class="btn btn-default"><i class="fa fa-clone"></i></a>
                                        <a class="btn btn-default" type="button" onclick="deleteEntity(this, '{{ addslashes($campaign->name) }}')" data-toggle="tooltip" title="Delete {{ addslashes($campaign->name) }}"><i class="fa fa-times text-danger"></i></a>
                                    </div>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        @if($campaigns->count() == 0)
                            <tr>
                                <td class="text-center" colspan="4"><i>You haven't created a campaign yet</i></td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="text-center">{{ $campaigns->links() }}</div>

            </div>
        </div>
    </div>
@endsection