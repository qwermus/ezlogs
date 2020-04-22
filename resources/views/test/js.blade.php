@extends('layouts.app')
@section('content')

<div style="max-width:900px;margin:auto;">
    <!-- Form -->
    {!! Form::open(['route' => 'clients.store', 'enctype' => 'multipart/form-data']) !!}

        <div class="row">

            <!-- Token -->
            <div class="form-group">
                {!! Form::label('api_token', 'TOKEN') !!}
                {!! Form::text('api_token', $token->api_token, [ 'class' => 'form-control' ]) !!}
            </div>

            <!-- Number of posts -->
            <div class="form-group">
                {!! Form::label('num', __('test.num')) !!}
                {!! Form::text('num', null, [ 'class' => 'form-control', 'maxlength' => '8' ]) !!}
            </div>

            <!-- Interval -->
            <div class="form-group">
                {!! Form::label('interval', __('test.interval')) !!}
                {!! Form::text('interval', null, [ 'class' => 'form-control', 'maxlength' => '5' ]) !!}
            </div>

            <!-- Photo -->
            <div class="form-group">
                {!! Form::label('photo', __('test.photo')) !!}
                <p>{{ __('test.photo_help') }}</p>
                {!! Form::file('photo') !!}
            </div>

        </div>

        <!-- Button -->
        <div class="form-group m-2">
            {!! Form::submit( __('test.submit'), ['class' => 'btn btn-primary start-script'] ); !!}
        </div>


    {!! Form::close() !!}
    <!-- ./Form -->
</div>
<div id="result"></div>

<script
    src="https://code.jquery.com/jquery-3.5.0.min.js"
    integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="
    crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){

        <!-- Make random string -->
        function makeIt(min, max, characters) {
            var length = Math.floor(Math.random() * (max - min) ) + min;
            var result           = '';
            var charactersLength = characters.length;
            for ( var i = 0; i < length; i++ ) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }

        $('form').on('submit', function(){
            event.preventDefault();
            // Get interval
            var interval = $(this).find("[name=interval]").val();
            if (typeof(interval) === 'undefined') {
                alert( '{{ __('test.wronginterval') }}');
                return false;
            }
            // Parse num
            interval = parseInt(interval) || 0;

            if (interval < 1 || interval > 10000) {
                alert( '{{ __('test.wronginterval') }}');
                return false;
            }

            // Get num
            var num = $(this).find("[name=num]").val();
            if (typeof(num) === 'undefined') {
                alert( '{{ __('test.wrongnum') }}');
                return false;
            }

            // Parse num
            num = parseInt(num) || 0;
            if (num < 1 || num > 10000000) {
                alert( '{{ __('test.wrongnum') }}');
                return false;
            }

            var formData = new FormData(this);
            var action = $(this).attr('action');
            var counter = 0;

            // Run interval
            let timerId = setInterval(function() {

                // Stop interval
                counter++;
                var cur = counter;
                if (counter >= num)
                {
                    clearInterval(timerId);
                }

                // Generate random data
                formData.append('firstname', makeIt( 2,10, 'abcdefghijklmnopqrstuvwxyz'));
                formData.append('surname', makeIt( 2,10, 'abcdefghijklmnopqrstuvwxyz'));
                formData.append('age', makeIt( 2,2, '23456789'));
                formData.append('license', makeIt( 2,2, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ') + makeIt( 6,6, '0123456789'));
                formData.append('phone_text', makeIt( 5,10, '0123456789'));
                formData.append('address', makeIt( 10,1000, ' abcdefghijklmnopqrstuvwxyz0123456789'));

                // Generate random comment
                for ($i = 1; $i <= {{config('api.commentMax')}}; $i ++) {
                    if (Math.random() >= 0.5) {
                        formData.append('comment['+$i+']', makeIt( 5,10000, ' abcdefghijklmnopqrstuvwxyz'));
                    }
                }

                $.ajax({
                    type:'POST',
                    url: action,
                    data:formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success:function(data){
                        $("#result").append("<p>" + cur + ": success</p>");
                        //console.log("success");
                        //console.log(data);
                    },
                    error: function(data){
                        $("#result").append("<p style=\"color:red;\">" + counter + ": failed</p>");
                        //console.log("error");
                        console.log(data);
                        clearInterval(timerId);
                    }
                });
            }, interval);

            return false;
            /*
            fieldData += "&action=sort";
            fieldData += "&_token=" + $('meta[name=csrf-token]').attr('content');
            <!-- Send a sort-request -->
            $.post( link, fieldData)
                .done(function(data) {
                })
                .fail(function(data) {
                });

             */
        });
    });
</script>
@endsection
