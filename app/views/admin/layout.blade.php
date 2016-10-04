<!DOCTYPE html>
<html class="no-js">
<head>
    {{ HTML::script('assets/js/jquery-2.1.1.min.js') }}
    {{ HTML::script('assets/js/common.js') }}
    @if(App::environment('local'))
        @foreach(Config::get('usermanager::assets.css_dev') as $style)
            {{ HTML::style($style) }}
        @endforeach
    @else
        @foreach(Config::get('usermanager::assets.css_production') as $style)
            {{ HTML::style($style) }}
        @endforeach
    @endif

    @if(Config::get('usermanager::config.direction') === 'rtl')
        <link rel="stylesheet" href="{{ asset('packages/vrigzalejo/usermanager/assets/css/bootstrap-rtl.min.css') }}" media="all">
        <link rel="stylesheet" href="{{ asset('packages/vrigzalejo/usermanager/assets/css/base-rtl.css') }}" media="all">
    @endif
    <link rel="stylesheet" href="{{ asset('packages/vrigzalejo/usermanager/assets/css/toggle-switch.css') }}" />

    <link rel="stylesheet" href="{{ asset('packages/vrigzalejo/usermanager/assets/css/base.css') }}" media="all">

    <link rel="stylesheet" href="{{ asset('packages/vrigzalejo/usermanager/assets/css/style.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('assets/css/nav.css') }}" media="all">

    @if(Config::get('usermanager::config.direction') === 'rtl')
        <link rel="stylesheet" href="{{ asset('packages/vrigzalejo/usermanager/assets/css/base-rtl.css') }}" media="all">
    @endif

    @if (!empty($favicon))
        <link rel="icon" {{ !empty($faviconType) ? 'type="' . $faviconType . '"' : '' }} href="{{ $favicon }}" />
    @endif

    <title>{{ (!empty($siteName)) ? $siteName : "User Manager"}} - {{isset($title) ? $title : '' }}</title>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">


</head>
<body>

@include('admin.header')
{{ isset($breadcrumb) ? Breadcrumbs::create($breadcrumb) : ''; }}

<div id="breadcrumb">
    <a href="http://localhost/lara/public/admin/users" class="tip-bottom current">&nbsp;</a>
</div>

<div id="content">
    <div class="col-lg-2">
        <nav class="navbar navbar-default sidebar" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="{{ URL::route('indexDashboard') }}">{{ trans('usermanager::navigation.index') }}<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>
                        <li ><a href="{{ URL::to('/') }}/admin/pages">Content<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-tasks"></span></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Languages<span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-filter"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ URL::to('/') }}/admin/languages"> Languages</a>
                                </li>
                                <li><a href="{{ URL::to('/') }}/admin/language-file-en"> English Language Editor</a>
                                </li>
                            <!--<li><a href="{{ URL::to('/') }}/admin/language-file-fr"> French language Editor</a>
                                        </li>-->
                                <li><a href="{{ URL::to('/') }}/admin/language-file-es"> Spanish language Editor</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Users<span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ URL::to('/') }}/users"> List</a></li>
                            </ul>
                        </li>
                        <li ><a href="{{ URL::to('/') }}/admin/categories">Categories<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-tasks"></span></a></li>
                        <li ><a href="{{ URL::to('/') }}/admin/products">Products<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-tasks"></span></a></li>
                        <li ><a href="{{ URL::to('/') }}/admin/orders">Orders<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-tasks"></span></a></li>
                        <li ><a href="{{ URL::to('/') }}/admin/districts">Districts<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-tasks"></span></a></li>
                        <li ><a href="{{ URL::to('/') }}/admin/faqs">FAQ's<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-tasks"></span></a></li>
                        <li ><a href="{{ URL::to('/') }}/admin/slider">Slider<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-tasks"></span></a></li>
                        <li ><a href="{{ URL::to('/') }}/filemanager/show"  target="_blank">Media Manager<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-globe"></span></a></li>
                        <li ><a href="{{ URL::to('logout') }}" >Logout<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-off"></span></a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="col-lg-10">
        <div class="row">
            <div class="col-lg-12">

                <message>
                    @if($errors->any())
                        <ul class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {{--set some message after action--}}
                    @if (Session::has('message'))
                        <div class="alert alert-success">{{ Session::get("message") }}</div>

                    @elseif(Session::has('error'))
                        <div class="alert alert-warning">{{ Session::get("error") }}</div>

                    @elseif(Session::has('info'))
                        <div class="alert alert-info">{{ Session::get("info") }}</div>

                    @elseif(Session::has('danger'))
                        <div class="alert alert-danger">{{ Session::get("danger") }}</div>
                    @endif
                </message>
            </div>
            <div class="col-lg-12">@yield('content')</div>
        </div>
    </div>
</div>


@if(App::environment('local'))
    @foreach(Config::get('usermanager::assets.js_dev') as $script)
        {{ HTML::script($script) }}
    @endforeach
@else
    @foreach(Config::get('usermanager::assets.js_production') as $script)
        {{ HTML::script($script) }}
    @endforeach
@endif


@if(App::environment('local'))
    <script>
        videojs.options.flash.swf = {{ Config::get('usermanager::assets.videojs_swf_dev') }}
    </script>
@else
    <script>
        videojs.options.flash.swf = {{ Config::get('usermanager::assets.videojs_swf_production') }}
    </script>
@endif

<script src="{{ asset('packages/vrigzalejo/usermanager/assets/js/dashboard/base.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
<script src="//cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.min.js"></script>
<script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init({
        selector: ".editor",

        theme: "modern",
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor"
        ],
        content_css: "css/content.css",
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
        style_formats: [
            {title: 'Bold text', inline: 'b'},
            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
            {title: 'Example 1', inline: 'span', classes: 'example1'},
            {title: 'Example 2', inline: 'span', classes: 'example2'},
            {title: 'Table styles'},
            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
        ]
    });
</script>
@yield('module_scripts')
</body>
</html>