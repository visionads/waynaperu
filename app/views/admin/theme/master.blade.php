<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.theme.header')
</head>

<body class="menubar-hoverable header-fixed ">

    @include('admin.theme.topbar')
    @yield('content')
    @include('admin.theme.leftmenubar')
    @include('admin.theme.rightcanvas')
    @include('admin.theme.footer')

</body>
</html>

