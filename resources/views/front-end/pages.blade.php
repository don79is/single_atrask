@extends('front-end.front-endCore')

@section('content')


    <div id="pages_title">
        {{$title}}
    </div>
    <div>
        <img src="{{$pages['image']['path']}}">
    </div>
    <h4>{{$description_long}}</h4>
@endsection