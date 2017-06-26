@extends('front-end.front-endCore')

@section('content')


    <div id="pages_title">
        {{$title}}
    </div>
    <div>
        <img src="{{asset ($pages['image']['path'])}}" class="image-size">
    </div>
    <h4>{{$description_long}}</h4>
@endsection