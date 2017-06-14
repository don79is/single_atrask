@extends('admin.adminCore')

@section('form')

    <div id="list">
        <div id="title">
            {{$title}}
        </div>
        {!! Form::open(['url' => $new, 'files' => true]) !!}
        @foreach( $fields as $field)

            @if($field['type'] == 'dropdown')

                {!! Form::label($field['key'], trans('app.' . $field['key'])) !!}<br/>
                {{Form::select($field['key'], $field['options'])}}<br/>

            @elseif( $field['type'] == 'singleline')
                {!! Form::label($field['key'], trans('app.' . $field['key'])) !!}<br/>
                {{Form::text($field['key'])}}<br/>

            @elseif( $field['type'] == 'checkbox')
                @foreach($field['options'] as $option)
                    {!! Form::label($option['title']) !!}<br/>
                    {{Form::checkbox($option['name'],$option['value'])}}<br/>


                @endforeach
            @endif
        @endforeach
        <a class="btn btn-primary" href="{{route($back)}}">{{ trans('app.back') }}</a>

        {{ Form::submit(trans('app.submit')) }}


        {!! Form::close() !!}
    </div>

@endsection