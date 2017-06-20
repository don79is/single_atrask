@extends('admin.adminCore')

@section('content')

    <div id="list">

        {{$title}}<br>
        @if(isset($new))
            <a href="{{$new}}" class="btn btn-primary" role="button">
                {{trans('app.new')}}</a>
            <hr/>
        @endif
        @if(sizeof($list)>0)

            <table class="table table-hover">
                <tr>
                    @foreach( $list[0] as $key => $value)

                        <th>{{$key}}</th>
                    @endforeach
                    @if(isset($edit))
                        <th> {{ trans('app.edit') }}</th>
                    @endif
                    @if(isset($delete))
                        <th> {{ trans('app.delete') }}</th>
                    @endif
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

                            @endif
                            @elseif($key == 'translation')
                                <td>
                                    @if(isset($value['name']))
                                        {{ $value['name'] . ' ' . $value['language_code'] }}
                                    @else
                                        {{ $value['title'] . ' ' . $value['language_code'] }}
                                    @endif
                                </td>

                            @elseif($key == 'role')

                                <td>
                                    {{ $value['role_id'] }}
                                </td>
                            @else
                                <td>  {{$value}}</td>
                            @endif
                        @endforeach
                        @if(isset ($edit))
                            <td><a class="btn btn-info"
                                   href="{{ route($edit, $item['id']) }}">{{ trans('app.edit') }}</a></td>
                        @endif
                        @if(isset ($delete))
                            <td>
                                <button class="btn btn-warning"
                                        onclick="deleteItem('{{route( $delete, $item['id'])}}', 0)">{{ trans('app.delete') }}</button>
                            </td>
                        @endif
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

        function deleteItem(route) {
            $.ajax({
                url: route,
                type: 'DELETE',
                data: {},
                dataType: 'json',
                success: function (response) {
                    $('#' + response.id).remove();
                },
                error: function () {
                    alert('Error');
                }
            });
        }
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

                    if (response.is_active === '1') {
                        $success.hide();
                        $danger.show()
                    }
                    else {
                        $success.show();
                        $danger.hide()
                    }


                }
            })
        }

    </script>
@endsection

