@extends('admin.adminCore')

@section('form')

    <div id="list">
        <div id="title">
            {{$title}}
        </div>
        {!! Form::open(['url' => $new, 'files' => true]) !!}
        @foreach( $fields as $field)

            {!! Form::label($field['key'], trans('app.' . $field['key'])) !!}<br/>

            @if($field['type'] == 'dropdown')

                @if(isset($record[$field['key']]))

                    @if($field['key'] == 'language_code'|| $field['key'] == 'time'|| $field['key'] == 'status' || $field['key'] == 'vr_rooms' ||  $field['key'] == 'user_id' )

                        {{Form::select($field['key'], $field['options'], $record[$field['key']])}}<br/>

                    @else
                        {{Form::select($field['key'], $field['options'], $record[$field['key']], ['placeholder' => ''])}}
                        <br/>
                    @endif

                @else
                    @if($field['key'] == 'language_code' || $field['key'] == 'time'|| $field['key'] == 'status' || $field['key'] == 'vr_rooms'||  $field['key'] == 'user_id')

                        {{Form::select($field['key'], $field['options'])}}<br/>

                    @else
                        {{Form::select($field['key'], $field['options'], null, ['placeholder' => ''])}}
                        <br/>
                    @endif
                @endif


            @elseif($field['type'] == 'singleline')

                @if(isset($record[$field['key']]))
                    {{Form::text($field['key'], $record[$field['key']])}}<br/>
                @else
                    {{Form::text($field['key'])}}<br/>
                @endif

            @elseif($field['type'] == 'textarea')

                @if(isset($record[$field['key']]))
                    {{Form::textarea($field['key'], $record[$field['key']])}}<br/>
                @else
                    {{Form::textarea($field['key'])}}<br/>
                @endif

            @elseif($field['type'] == 'file')
                @if(isset($record[$field['key']]))
                    {{Form::file('file'),$record[$field['key']]}}
                    <img src="{{asset ($record['path'])}}" class="image-size">


                @else
                    {{Form::file('file')}}
                @endif

                {{--TODO show image--}}
                {{--TODO show delete chekcbox--}}|


            @elseif($field['type'] == 'checkbox')

                @foreach($field['options'] as $option)


                    @if(isset($record[$field['key']]))

                        {{Form::checkbox($option['name'], $option['value'], $record[$field['key']])}}
                    @else
                        {{Form::checkbox($option['name'], $option['value'])}}
                    @endif


                    {!! Form::label($option['title']) !!}<br/>
                @endforeach

            @endif


        @endforeach


        <div style="padding-top: 20px">
            {{ Form::submit(trans('app.submit')) }}
        </div>
        <br>
        <a class="btn btn-primary" href="{{route($back)}}">{{ trans('app.back') }}</a>


        {!! Form::close() !!}
    </div>

@endsection

@section('scripts')
    <script>
        $('#language_code').bind("change", function () {
//            console.log(window.location.href)
                window.location.href = "?language_code=" + $('#language_code').val();
//            alert($('#language_code').val())
            }
        )

        var time = $('#time');
        var vr_rooms = $('#vr_rooms');

        if (time.length > 0 &&
            (vr_rooms.length > 0)) {
            vr_rooms.bind("change", getAvalebleHouers);
            time.bind("change", getAvalebleHouers);
        }
        function getAvalebleHouers() {

            console.log(vr_rooms.val(), time.val())
            $.ajax({
                url: '{{route('app.order.reserved')}}',

                type: 'GET',
                data: {
                    time: time.val(),
                    experience_id: vr_rooms.val()
                },

                success: function (response) {
                    console.log(response);
                },

                error: function () {
                    alert('ERROR');
                }

            });

        }


    </script>
@endsection