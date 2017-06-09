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

                @foreach( $list as $item )
                    <tr id="{{$item['id']}}">
                        @foreach( $item as $key => $value)

                            @if ($key == 'is_active')
                                <td> @if($value ==1)
                                        <button style="display: none" type="button" class="btn btn-success"
                                                onclick="toggleActive('{{route($call,$item['id'])}}',1)">{{trans('app.success')}}</button>
                                        <button type="button" class="btn btn-danger"
                                                onclick="toggleActive ('{{route($call,$item['id'])}}',0)">{{trans('app.danger')}}
                                        </button>
                                    @else
                                        <button style="display: none" type="button" class="btn btn-danger"
                                                onclick="toggleActive ('{{route($call,$item['id'])}}',0)">{{trans('app.danger')}}
                                        </button>
                                        <button type="button" class="btn btn-success"
                                                onclick="toggleActive ('{{route($call,$item['id'])}}',1)">{{trans('app.success')}}</button>
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

            $.ajax
            ({
                url: url,
                type: 'POST',
                data: {is_active: value},
                success: function (response) {
                    var $danger = ($('#' + response.id).find('.btn-danger'));
                    var $success = ($('#' + response.id).find('.btn-success'));
//                    console.log( $disable, $anable)

                    console.log($danger, $success);

                    if(response.is_active === '1'){
                        $success.hide();
                        $danger.show()
                    }
                    else
                    {
                        $success.show();
                        $danger.hide()
                    }


                }
            })
        }

    </script>
@endsection

