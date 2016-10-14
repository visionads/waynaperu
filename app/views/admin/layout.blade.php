<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.theme.header')
</head>

<body class="menubar-hoverable header-fixed ">
    @include('admin.theme.topbar')
    {{--Base Start--}}
    <div id="base">
        <div class="offcanvas"></div>



        <div id="content">
            <section>
                <div class="section-body">
                    <div class="row">
                        @include('admin.theme.errormessage')
                        @yield('content')
                    </div>
                </div>
            </section>
        </div>
    </div>
    {{--Base End--}}
    @include('admin.theme.leftmenubar')
    @include('admin.theme.rightcanvas')
    @include('admin.theme.footer')
</body>
</html>
