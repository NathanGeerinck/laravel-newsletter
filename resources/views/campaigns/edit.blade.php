@extends('layouts.app')

@section('title', 'Edit campaign: ' . $campaign->name)

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
                {!! Form::model($campaign, ['route' => ['campaigns.edit', $campaign]]) !!}

                @include('forms.campaigns')

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(".chosen-select").chosen();
    </script>
@endsection