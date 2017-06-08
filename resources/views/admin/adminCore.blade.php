<!doctype html>
<html lang="EN">
<head>
    @include('admin.adminCss')
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="/css/app.css" rel=stylesheet>
</head>
<body>
@include('admin.adminMenu')

@yield('content')

</body>
@yield('scripts')
</html>
