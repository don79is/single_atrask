<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            @foreach( $menu as $menuItem)
                {{--{{dd($menuItem)}}--}}
                @if($menuItem['children'] != null)

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">{{$menuItem['translation']['name']}}</a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            @foreach( $menuItem['children'] as $item)
                                <a class="dropdown-item" href="#">{{$item['translation']['name']}} </a>
                            @endforeach
                        </div>

                    </li>
                @else
                    <li class="nav-item active">
                        <a class="nav-link" href="#">{{$menuItem['translation']['name']}}</a>
                    </li>
                @endif

            @endforeach
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">Kalba</a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    @foreach( $lang as $key => $value)
                        <a class="dropdown-item" href="{{$key}}">{{$value}} </a>
                    @endforeach
                </div>

            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">Kambariai</a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                    @foreach( $rooms as $value)

                        <a class="dropdown-item" href="/{{app()->getlocale().'/pages/'. ($value['translation']['slug'])}}">{{$value['translation']['title']}} </a>
                    @endforeach
                </div>

            </li>

        </ul>

    </div>
</nav>


