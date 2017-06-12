@extends('admin.adminCore')

@section('form')

    <div class="container">
        {{$title}}
        {!!Form::open(['url' => route('app.language.create'),'files' => true]) !!}
        @foreach( $fields as $field)

            @if($field['type'] == 'dd')
                {{Form::label('languages', 'Kalbos')}}
                {{ Form::select('language',$field['options'])}}

                @elseif( $field['type'] == 'sl')
                {{Form::label('languages', 'Kalba')}}
                {{ Form::text('language',$field['name'])}}




            @endif
        @endforeach
    </div>

@endsection