@extends('admin.adminCore')

@section('content')
    <div id="list">
        @if(sizeof($list)>0)

            <table class="table table-hover">
                <tr>
                    @foreach( $list[0] as $key => $value)

                        <th>{{$key}}</th>

                    @endforeach
                </tr>
                <tr>
                    @foreach( $list as $item )

                        @foreach( $item as $key => $value)

                            @if ($key == 'is_active')
                                <td> @if($value ==1)
                                <button style="display: none" type="button" class="btn btn-success">Success</button>
                                <button type="button" class="btn btn-danger">Danger</button>
                            @else
                                <button style="display: none" type="button" class="btn btn-danger">Danger</button>
                                <button type="button" class="btn btn-success">Success</button>
                                </td>
                                @endif

                                @else
                                    <td>  {{$value}}</td>
                                @endif
                                @endforeach
                </tr>
                @endforeach

            </table>
        @else {{trans('app.no-data')}}

        @endif
    </div>

@endsection