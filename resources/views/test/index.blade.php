@extends('layouts.app')
@section('content')

<div style="max-width:900px;margin:auto;">
    <!-- Form -->
    {!! Form::open(['route' => 'clients.store', 'enctype' => 'multipart/form-data']) !!}
    @for($i = 0; $i < $q; $i ++)

        <h1>User {{ $i + 1 }}:</h1>
        <!-- User's form -->
        <div class="row">

            <!-- First col -->
            <div class="col-sm p-4">


                <!-- User's name -->
                <div class="form-group">
                    {!! Form::label('firstname', __('test.firstname')) !!}
                    <p>{{ __('test.firstname_help') }}</p>
                    {!! Form::text('firstname['.$i.']', null, [ 'class' => 'form-control', 'maxlength' => '10' ]) !!}
                </div>

                <!-- User's surname -->
                <div class="form-group">
                    {!! Form::label('surname', __('test.surname')) !!}
                    <p>{{ __('test.surname_help') }}</p>
                    {!! Form::text('surname['.$i.']', null, [ 'class' => 'form-control', 'maxlength' => '10' ]) !!}
                </div>

                <!-- User's age -->
                <div class="form-group">
                    {!! Form::label('age', __('test.age')) !!}
                    <p>{{ __('test.age_help') }}</p>
                    {!! Form::text('age['.$i.']', null, [ 'class' => 'form-control', 'maxlength' => '3' ]) !!}
                </div>
            </div>
            <!-- /.First col -->

            <!-- Second col -->
            <div class="col-sm p-4">

                <!-- User's photo -->
                <div class="form-group">
                    {!! Form::label('photo', __('test.photo')) !!}
                    <p>{{ __('test.photo_help') }}</p>
                    {!! Form::file('photo['.$i.']') !!}
                </div>

                <!-- User's license -->
                <div class="form-group">
                    {!! Form::label('license', __('test.license')) !!}
                    <p>{{ __('test.license_help') }}</p>
                    {!! Form::text('license['.$i.']', null, [ 'class' => 'form-control', 'maxlength' => '8' ]) !!}
                </div>

                <!-- User's phone -->
                <div class="form-group">
                    {!! Form::label('phone_text', __('test.phone_text')) !!}
                    <p>{{ __('test.phone_text_help') }}</p>
                    {!! Form::text('phone_text['.$i.']', null, [ 'class' => 'form-control', 'maxlength' => '15' ]) !!}
                </div>

                <!-- User's address -->
                <div class="form-group">
                    {!! Form::label('address', __('test.address')) !!}
                    <p>{{ __('test.address_help') }}</p>
                    {!! Form::textarea('address['.$i.']', null, [ 'class' => 'form-control' ]) !!}
                </div>

            </div>
            <!-- /.Second col -->

        </div>
        <!-- /.User's form -->




        <p>{{ __('test.comment_help') }}</p>

        <!-- Comments -->
        <div class="row">

            <!-- First col -->
            <div class="col-sm p-4">

                @for ($k = 1; $k <= config('api.commentMax'); $k = $k + 2)

                    <!-- User's comment #{{$k}} -->
                    <div class="form-group">
                        {!! Form::label('comment-'.$i.'-'.$k, __('test.comment', ['counter' => $k])) !!}
                        {!! Form::textarea('comment['.$i.']['.$k.']', null, [ 'id' => 'comment-'.$i.'-'.$k, 'class' => 'form-control' ]) !!}
                    </div>

                @endfor

            </div>
            <!-- /.First col -->

            <!-- Second col -->
            <div class="col-sm p-4">

                @for ($k = 2; $k <= config('api.commentMax'); $k = $k + 2)

                    <!-- User's comment #{{$k}} -->
                    <div class="form-group">
                        {!! Form::label('comment-'.$i.'-'.$k, __('test.comment', ['counter' => $k])) !!}
                        {!! Form::textarea('comment['.$i.']['.$k.']', null, [ 'id' => 'comment-'.$i.'-'.$k, 'class' => 'form-control' ]) !!}
                    </div>

                @endfor

            </div>
            <!-- /.Second col -->

        </div>
        <!-- /.Comments -->

    @endfor

    <!-- Token -->
    <div class="form-group">
        {!! Form::label('api_token', 'TOKEN') !!}
        {!! Form::text('api_token', $token->api_token, [ 'class' => 'form-control' ]) !!}
        {!! Form::hidden('quantity', $q) !!}
    </div>

    <!-- Button -->
    <div class="form-group m-2">
        {!! Form::submit( __('test.submit'), ['class' => 'btn btn-primary'] ); !!}
    </div>

    {!! Form::close() !!}
    <!-- ./Form -->
</div>
@endsection
