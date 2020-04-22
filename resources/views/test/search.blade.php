@extends('layouts.app')
@section('content')

<div style="max-width:900px;margin:auto;">
    <!-- Form -->
    {!! Form::open(['route' => 'clients.search']) !!}

        <!-- User's form -->
        <div class="row">

            <!-- First col -->
            <div class="col-sm p-4">

                <!-- User's name -->
                <div class="form-group">
                    {!! Form::label('api_token', 'TOKEN') !!}
                    {!! Form::text('api_token', $token->api_token, [ 'class' => 'form-control' ]) !!}
                </div>

                <!-- User's name -->
                <div class="form-group">
                    {!! Form::label('firstname', __('test.firstname')) !!}
                    {!! Form::text('firstname', null, [ 'class' => 'form-control', 'maxlength' => '10' ]) !!}
                </div>

                <!-- User's surname -->
                <div class="form-group">
                    {!! Form::label('surname', __('test.surname')) !!}
                    {!! Form::text('surname', null, [ 'class' => 'form-control', 'maxlength' => '10' ]) !!}
                </div>

                <!-- User's age -->
                <div class="form-group">
                    {!! Form::label('age_from', __('test.age')) !!}
                    {!! Form::text('age_from', null, [ 'class' => 'form-control', 'maxlength' => '3', 'style' => 'width:50px' ]) !!}
                    &ndash;
                    {!! Form::text('age_till', null, [ 'class' => 'form-control', 'maxlength' => '3', 'style' => 'width:50px' ]) !!}
                </div>

                <!-- Button -->
                <div class="form-group m-2">
                    {!! Form::submit( __('test.search'), ['class' => 'btn btn-primary'] ); !!}
                </div>
            </div>
            <!-- /.First col -->

            <!-- Second col -->
            <div class="col-sm p-4">

                <!-- User's photo -->
                <div class="form-group">
                    {!! Form::label('photo', __('test.photo')) !!}
                    {!! Form::text('photo', null, [ 'class' => 'form-control' ]) !!}
                </div>

                <!-- User's license -->
                <div class="form-group">
                    {!! Form::label('license', __('test.license')) !!}
                    {!! Form::text('license', null, [ 'class' => 'form-control', 'maxlength' => '8' ]) !!}
                </div>

                <!-- User's phone -->
                <div class="form-group">
                    {!! Form::label('phone_text', __('test.phone_text')) !!}
                    {!! Form::text('phone_text', null, [ 'class' => 'form-control', 'maxlength' => '15' ]) !!}
                </div>

                <!-- User's address -->
                <div class="form-group">
                    {!! Form::label('address', __('test.address')) !!}
                    {!! Form::text('address', null, [ 'class' => 'form-control', 'maxlength' => '1000' ]) !!}
                </div>

                <!-- User's comment -->
                <div class="form-group">
                    {!! Form::label('comment', __('test.comment', ['counter' => 'N'])) !!}
                    {!! Form::textarea('comment', null, [ 'class' => 'form-control' ]) !!}
                </div>

            </div>
            <!-- /.Second col -->

        </div>
        <!-- /.User's form -->

    {!! Form::close() !!}
    <!-- ./Form -->
</div>
@endsection
