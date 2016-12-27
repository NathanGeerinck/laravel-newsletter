@extends('layouts.app')

@section('title', 'Edit subscription: ' . $subscription->email)

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                @yield('title')
                <div class="pull-right">
                    <div class="btn-group btn-group-xs">
                        <a href="{{ route('subscriptions.index') }}" type="button" class="btn btn-default">Back to overview</a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
            {!! Form::model($subscription, ['route' => ['subscriptions.update', $subscription]]) !!}

            @include('forms.subscriptions')

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