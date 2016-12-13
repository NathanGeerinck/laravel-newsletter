@extends('layouts.app')

@section('title', 'Settings')

@section('content')
    <div class="container">
        <div class="row">
            @include('settings.parts.sidebar')
            <div class="col-md-8 col-lg-8">
                <div class="tab-content">
                    <div class="panel panel-default tab-pane active" role="tabpanel" id="application">
                        <div class="panel-heading">

                        </div>
                        <div class="panel-body">
                            {!! Form::open(['route' => 'settings.driver']) !!}

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection