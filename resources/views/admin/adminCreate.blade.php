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


    </script>
@endsection