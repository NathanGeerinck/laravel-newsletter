@extends('layouts.app')

@section('title', 'Unsubscribe')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                @yield('title')
            </div>
            <div class="panel-body">
                {!! Form::open(['route' => ['subscriptions.unsubscribe', $subscription], 'method' => 'DELETE']) !!}
                <a class="btn btn-default btn-lg btn-" type="button" onclick="deleteEntity(this, '{{ addslashes($subscription->email) }}')" data-toggle="tooltip" title="Unsubscribe">Unsubscribe</a>
                {!! Form::close() !!}
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