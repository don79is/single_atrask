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
                                        <button style="display: none" type="button" class="btn btn-success"
                                                onclick="toggleActive('{{route($call,$item['id'])}}',0)">{{trans('app.success')}}</button>
                                        <button type="button" class="btn btn-danger"
                                                onclick="toggleActive ('{{route($call,$item['id'])}}',1)">Danger
                                        </button>
                                    @else
                                        <button style="display: none" type="button" class="btn btn-danger"
                                                onclick="toggleActive ('{{route($call,$item['id'])}}',1)">Danger
                                        </button>
                                        <button type="button" class="btn btn-success"
                                                onclick="toggleActive ('{{route($call,$item['id'])}}',0)">{{trans('app.success')}}</button>
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

@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function toggleActive(url, value) {
            console.log(url, value);
        }

    </script>
@endsection

