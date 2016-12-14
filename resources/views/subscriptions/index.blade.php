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
                {!! Form::model(request()->all(), ['route' => 'subscriptions.filter', 'method' => 'get']) !!}

                <div class="col-xs-6">
                    <div class="input-group">
                        {!! Form::select('mailing_list', $lists, null, ['class' => 'chosen-select', 'placeholder' => '']) !!}

                        <div class="input-group-btn">
                            {!! Form::submit('Search', ['class' => 'btn btn-default']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="input-group">
                        {!! Form::text('filter', null, ['class' => 'form-control', 'placeholder' => 'Search by email or name']) !!}

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
                                <div class="btn-group btn-group-sm" role="group" aria-label="">
                                    <a href="{{ route('subscriptions.show', $subscription) }}" class="btn btn-default"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('subscriptions.edit', $subscription) }}" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ route('subscriptions.clone', $subscription) }}" class="btn btn-default"><i class="fa fa-clone"></i></a>
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

@section('javascript')
    <script>
        $(".chosen-select").chosen({
            allow_single_deselect: true
        });
    </script>
@endsection