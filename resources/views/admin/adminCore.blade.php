<!doctype html>
<html lang="EN">
<head>
    @include('admin.adminCss')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <title>{{trans('app.title')}}</title>
    <link href="/css/app.css" rel=stylesheet>
</head>
<body>
@include('admin.adminMenu')

@yield('content')

@yield('list')
@yield('form')
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@yield('scripts')
</html>
