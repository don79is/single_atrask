@extends('admin.adminCore')

@section('content')
    <div id="list">
        <h2>{{trans('app.new_record')}}{{$title}}</h2>

        {!! Form::open(['url' => $new,'files' => true]) !!}
        @foreach($fields as $field)
            @if(!($field['type'] == 'check_box'))
                {{ Form::label($field['key'], trans('app.' . $field['key'])) }}
            @endif

            @if($field['type'] == 'dropdown')
                @if(isset($record[$field['key']]))
                    {{--@if(isset($record[$field['key']]) && $field['key'] == 'user_id' )--}}
                    {{--<div class="form-group">--}}
                    {{--{{ Form::label($field['key'],$record[$field['key']])}}--}}
                    {{--</div>--}}
                    {{--@endif--}}

                    @if($field['key'] == 'language_code' || $field['key'] == 'category_id' || $field['key'] == 'user_id' || $field['key'] == 'status')
                        <div class="form-group">
                            {{Form::select($field['key'],$field['options'], $record[$field['key']])}}
                        </div>
                    @else
                        <div class="form-group">
                            {{Form::select($field['key'],$field['options'], $record[$field['key']], ['placeholder' => '']) }}
                        </div>
                    @endif

                @else

                    @if($field['key'] == 'language_code' || $field['key'] == 'category_id' || $field['key'] == 'user_id' || $field['key'] == 'status')
                        <div class="form-group">
                            {{Form::select($field['key'],$field['options'])}}
                        </div>
                    @else
                        <div class="form-group">
                            {{Form::select($field['key'],$field['options'], null, ['placeholder' => ''] ) }}
                        </div>
                    @endif

                @endif


            @elseif($field['type'] == 'single_line')
                @if(isset ($record[$field['key']]))
                    <div class="form-group">
                        {{ Form::text($field['key'],$record[$field['key']])}}
                    </div>
                @else
                    <div class="form-group">
                        {{ Form::text($field['key'])}}
                    </div>
                @endif

            @elseif($field['type'] == 'textarea')
                @if(isset ($record[$field['key']]))
                    <div class="form-group">
                        {{ Form::textarea($field['key'],$record[$field['key']],['rows' => $field['rows'], 'columns' => $field['columns'], ])}}
                    </div>
                @else
                    <div class="form-group">
                        {{ Form::textarea($field['key'],null,['rows' => $field['rows'], 'columns' => $field['columns'] , 'class' => 'form_textarea'])}}
                    </div>
                @endif


            @elseif($field['type'] == 'check_box')
                @if(isset($record[$field['key']]))
                    @foreach($field['options'] as $option)
                        <div class="form-group">
                            {{Form::label($option['title'])}}
                            {{Form::checkbox($option['name'],$option['value'], $record[$field['key']])}}
                        </div>
                    @endforeach
                @else
                    @foreach($field['options'] as $option)
                        <div class="form-group">
                            {{Form::label($option['title'])}}
                            {{Form::checkbox($option['name'],$option['value'])}}
                        </div>
                    @endforeach
                @endif

            @elseif($field['type'] == 'file')
                @if(isset($record[$field['key']]))
                    <div class="form-group">
                        <td><img src="{{$record['path']}}" height="60" width="90"></td>
                        {{Form::file('file'),$record[$field['key']]}}
                    </div>
                @else
                    <div class="form-group">
                        {{Form::file('file')}}
                    </div>
                @endif

            @elseif($field['type'] == 'user_down')
                @if(isset($record[$field['key']]))
                    <div class="form-group">
                        {{ Form::label($user_email['email']) }}
                    </div>
                @else
                    <div class="form-group">
                        {{Form::select($field['key'],$field['options'])}}
                    </div>

                @endif

            @elseif($field['type'] == 'reservations')
                <div id="reservations"></div>
                <div id="reservations-invisible" style="display: none;"></div>
            @endif




        @endforeach

        <a class="btn btn-primary" href="{{route($back)}}">{{ trans('app.back') }}</a>

        {{Form::submit(trans('app.save'), array('class' => 'btn btn-success')) }}

        {!!Form::close()!!}
    </div>
@endsection
@section('scripts')
    <script>
        $('#language_code').bind(
            'change', function () {
                window.location.href = "?language_code=" + $('#language_code').val();
            });
        var $time = $('#time');
        var $vr_rooms = $('#vr_rooms');

        function getAvailableHours() {
            $.ajax({
                url: '{{ route('app.order.index') }}',
                type: 'GET',
                data: {
                    time: $time.val(),
                    experience_id: $vr_rooms.val()
                },
                success: function (response) {
//                    generateCheckBoxes
//                      (prepareForCheckBox($time.val(), response));
                    generateCheckBoxes($time.val(), response);
                },
                error: function () {
                    alert('ERROR')
                }
            });
        }
        if ($time.length > 0 && $vr_rooms.length > 0) {
            $time.bind('change', getAvailableHours);
            $vr_rooms.bind('change', getAvailableHours);
            function prepareForCheckBox(day, reserved) {
                // new date
                var date = new Date(day + ' 00:00:00');
                // checking if date is today
                if (date.toDateString() == new Date().toDateString())
                    date = new Date();
                // closing time property
                var closingTime = 22;
                // opening time property
                var openingTime = 10;
                // available times for this
                var availableTimes = [];
                // allow rezervation 2 hours from now
                date.setHours(date.getHours() + 2);
                // moving minutes to dividable by 10
                date.setMinutes(Math.ceil(date.getMinutes() / 10) * 10);
                // while it is not closing time execute
                while (date.getHours() < closingTime) {
                    // cheking if hours are more than opening time
                    if (date.getHours() >= openingTime) {
                        // creating rezervation time visible for users
                        var time = date.getHours() + ':' + pad(date.getMinutes(), 2);
                        // creating dateTime / id which will be recorded in the databse
                        var dateTime = day + ' ' + time + ':00';
                        // adding data to array
                        availableTimes.push(
                            {
                                title: time,
                                id: dateTime,
                                // cheking if time is reserved
                                reserved: reserved.indexOf(dateTime) >= 0 ? 1 : 0
                            });
                    }
                    // interval each 10 minutes
                    // increasing time by 10 minutes
                    date.setMinutes(date.getMinutes() + 10);
                }
                // function which adds zeros from left size of the number 1 -> 001
                function pad(num, size) {
                    var s = num + "";
                    while (s.length < size) s = "0" + s;
                    return s;
                }
                return availableTimes;
            }
        }
        function generateCheckBoxes(time, resp) {
            var a = prepareForCheckBox(time, resp);
            var checkboxes = '';
            var exp = $('#vr_rooms').val();
            a.forEach(function (entry) {
                //ToDO check if entry is reserved, If yes then check and disable it else normal
                if (entry.reserved === 1)
                    checkboxes += '<input type="checkbox" name="' + exp + '[]" value="' + entry.id + '" checked disabled > ' + entry.title + '<br>';
                else
                    checkboxes += '<input type="checkbox" name="' + exp + '[]" value="' + entry.id + '">' + entry.title + '<br>';
            });
            $('#reservations').html(checkboxes);
            $("input[name|='" + exp + "[]']").bind('click', function (e) {
                console.log($(e.currentTarget).val());
                $('#reservations-invisible').append('<input id="' + $(this).attr('value') + '" type="checkbox" name="' + $(this).attr('name') + '" value="' + $(this).attr('value') + '" checked>');
            });
        }

    </script>
@endsection