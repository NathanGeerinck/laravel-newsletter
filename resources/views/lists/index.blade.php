@extends('layouts.app')

@section('title', 'Lists (' . $lists->total() . ')')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                @yield('title')
                <div class="pull-right">
                    <div class="btn-group btn-group-xs">
                        <a href="{{ route('lists.new') }}" type="button" class="btn btn-default">Create list</a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-xs-12 col-md-6 col-md-offset-3">
                {!! Form::model(request()->all(), ['route' => 'lists.filter', 'method' => 'get']) !!}
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
                            <th style="width: 35%;">Name</th>
                            <th class="text-center" style="width: 15%;">Subscriptions</th>
                            <th class="text-center" style="width: 15%;">Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lists as $list)
                            <tr>
                                <td class="text-center">{{ $list->id }}</td>
                                <td>{{ $list->name }}</td>
                                <td class="text-center"><span class="label label-info">{{ $list->subscriptions->count() }}</span></td>
                                <td class="text-center">@if($list->public) <span class="label label-info"><i class="fa fa-globe"></i></span> @else <span class="label label-info"><i class="fa fa-lock"></i></span> @endif</td>
                                <td class="text-center">
                                    {!! Form::open(['route' => ['lists.delete', $list], 'method' => 'DELETE']) !!}
                                    <div class="btn-group btn-group-sm" role="group" aria-label="">
                                        <a href="{{ route('lists.show', $list) }}" class="btn btn-default"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('lists.edit', $list) }}" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                                        <a href="{{ route('lists.clone', $list) }}" class="btn btn-default"><i class="fa fa-clone"></i></a>
                                        <a class="btn btn-default" type="button" onclick="deleteEntity(this, '{{ addslashes($list->name) }}')" data-toggle="tooltip" title="Delete {{ addslashes($list->name) }}"><i class="fa fa-times text-danger"></i></a>
                                    </div>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center">{{ $lists->links() }}</div>
            </div>
        </div>
    </div>
@endsection