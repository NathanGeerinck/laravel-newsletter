@extends('layouts.app')

@section('title', 'Subscriptions (' . $subscriptions->total() . ')')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                @yield('title')
                <div class="pull-right">
                    <div class="btn-group btn-group-xs">
                        <a href="{{ route('subscriptions.new') }}" type="button" class="btn btn-default">Add subscription</a>
                        <a href="{{ route('subscriptions.export', 'csv') }}" type="button" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Export all subscriptions to CSV"><i class="fa fa-table" aria-hidden="true"></i></a>
                        <a href="{{ route('subscriptions.export', 'xlsx') }}" type="button" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Export all subscriptions to XLSX"><i class="fa fa-file-excel-o" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                {!! Form::model(request()->all(), ['route' => 'subscriptions.filter', 'method' => 'get']) !!}
                <div class="col-xs-12 col-md-6 col-md-offset-3">
                    <div class="input-group">
                        {!! Form::text('filter', null, ['class' => 'form-control', 'placeholder' => 'Search']) !!}
                        <div class="input-group-btn">
                            {!! Form::submit('Search', ['class' => 'btn btn-default']) !!}
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
                <br><br>
                <table class="table" id="exceptions">
                    <thead>
                    <tr>
                        <th class="text-center" style="">ID</th>
                        <th style="">Email</th>
                        <th style="">Name</th>
                        <th class="text-center">List</th>
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
                                    <a class="btn btn-default" type="button" onclick="deleteEntity(this, '{{ addslashes($subscription->email) }}')" data-toggle="tooltip" title="Delete {{ addslashes($subscription->email) }}"><i class="fa fa-times text-danger"></i></a>
                                </div>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    @if($subscriptions->count() == 0)
                        <tr>
                            <td class="text-center" colspan="5"><i>You haven't added a subscription yet</i></td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                <div class="text-center">{{ $subscriptions->links() }}</div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(".chosen-select").chosen({
            allow_single_deselect: true
        });
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection