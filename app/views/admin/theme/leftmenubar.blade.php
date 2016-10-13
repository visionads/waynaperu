<!-- BEGIN MENUBAR-->
<div id="menubar" class="menubar-inverse ">
    <div class="menubar-fixed-panel">
        <div>
            <a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
                <i class="fa fa-bars"></i>
            </a>
        </div>
        <div class="expanded">
            <a href="{{ URL::route('indexDashboard') }}">
                <span class="text-lg text-bold text-primary ">Half &nbsp; Way</span>
            </a>
        </div>
    </div>
    <div class="menubar-scroll-panel">

        <!-- BEGIN MAIN MENU -->
        <ul id="main-menu" class="gui-controls">

            <li>
                <a href="{{ URL::route('indexDashboard') }}" class="active">
                    <div class="gui-icon"><i class="md md-home"></i></div>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ URL::to('/') }}/admin/pages" >
                    <div class="gui-icon"><i class="fa fa-file"></i></div>
                    <span class="title">Content</span>
                </a>
            </li>
            <li class="gui-folder">
                <a>
                    <div class="gui-icon"><i class="fa fa-language"></i></div>
                    <span class="title">Languages</span>
                </a>
                <!--start submenu -->
                <ul>
                    <li><a href="{{ URL::to('/') }}/admin/languages"><span class="title"> Languages</span></a></li>
                    <li><a href="{{ URL::to('/') }}/admin/language-file-en"><span class="title"> English Language Editor</span></a></li>
                    <!--<li><a href="{{ URL::to('/') }}/admin/language-file-fr"><span class="title"> French language Editor</span></a></li>-->
                    <li><a href="{{ URL::to('/') }}/admin/language-file-es"><span class="title"> Spanish language Editor</span></a></li>
                </ul>
            </li>
            <li class="gui-folder">
                <a>
                    <div class="gui-icon"><i class="fa fa-user"></i></div>
                    <span class="title">Users</span>
                </a>
                <!--start submenu -->
                <ul>
                    <li><a href="{{ URL::to('users/admin') }}"><span class="title"> Admin </span></a></li>
                    <li><a href="{{ URL::to('users/provider') }}"><span class="title"> Provider </span></a></li>
                    <li><a href="{{ URL::to('users/client') }}"><span class="title"> Client </span></a></li>
                    <li><a href="{{ URL::to('user/activity') }}" ><span class="title">User Activity</span></a></li>
                </ul>
            </li>
            <li>
                <a href="{{ URL::to('/') }}/admin/categories" >
                    <div class="gui-icon"><i class="fa fa-table"></i></div>
                    <span class="title">Categories</span>
                </a>
            </li>
            <li>
                <a href="{{ URL::to('/') }}/admin/products" >
                    <div class="gui-icon"><i class="fa fa-apple"></i></div>
                    <span class="title">Products</span>
                </a>
            </li>
            <li>
                <a href="{{ URL::to('/') }}/admin/orders" >
                    <div class="gui-icon"><i class="fa fa-check-square"></i></div>
                    <span class="title">Orders</span>
                </a>
            </li>
            <li>
                <a href="{{ URL::to('/') }}/admin/districts" >
                    <div class="gui-icon"><i class="fa fa-archive"></i></div>
                    <span class="title">Districts</span>
                </a>
            </li>
            <li>
                <a href="{{ URL::to('/') }}/admin/faqs" >
                    <div class="gui-icon"><i class="fa fa-question"></i></div>
                    <span class="title">FAQ's</span>
                </a>
            </li>
            <li>
                <a href="{{ URL::to('/') }}/admin/slider" >
                    <div class="gui-icon"><i class="fa fa-laptop"></i></div>
                    <span class="title">Slider</span>
                </a>
            </li>
            <li>
                <a href="{{ URL::to('/') }}/filemanager/show" >
                    <div class="gui-icon"><i class="fa fa-medium"></i></div>
                    <span class="title">Media Manager</span>
                </a>
            </li>
            {{--<li>
                <a href="{{ URL::to('user/activity') }}" >
                    <div class="gui-icon"><i class="fa fa-circle"></i></div>
                    <span class="title">User Activity</span>
                </a>
            </li>--}}
            <li>
                <a href="{{ URL::to('logout') }}" >
                    <div class="gui-icon"><i class="fa fa-sign-out"></i></div>
                    <span class="title">Logout</span>
                </a>
            </li>
        </ul><!--end .main-menu -->
        <!-- END MAIN MENU -->

        <div class="menubar-foot-panel">
            <small class="no-linebreak hidden-folded">
                <span class="opacity-75">Copyright &copy; 2014</span> <strong>CodeCovers</strong>
            </small>
        </div>
    </div><!--end .menubar-scroll-panel-->
</div><!--end #menubar-->
<!-- END MENUBAR -->
