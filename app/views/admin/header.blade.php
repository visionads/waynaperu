<div class="navbar navbar-inverse navbar-default">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ (!empty($siteUrl)) ? $siteUrl : '/'}} ">
            {{ (!empty($siteName)) ? $siteName : "Wayna"}}

            <div class="visible-sm"><img class="ajax-loader ajax-loader-sm" src="{{ asset('packages/vrigzalejo/usermanager/assets/img/ajax-load.gif') }}" style="float: right;"/></div>
        </a>
    </div>

    <div class="navbar-collapse collapse navbar-responsive-collapse">
        @if(Sentry::check())
        <ul class="nav navbar-nav navbar-{{ (Config::get('usermanager::config.direction') === 'rtl') ? 'left' : 'right' }}">
            <li class="hidden-sm"><img class="ajax-loader ajax-loader-lg" src="{{ asset('packages/vrigzalejo/usermanager/assets/img/ajax-load.gif') }}" style="float: right;"/></li>
            {{ (!empty($navPagesRight)) ? $navPagesRight : '' }}
            <li><a href="{{ URL::route('showUser', Sentry::getUser()->id ) }}"><span class="text">{{ Sentry::getUser()->username }}</span></a></li>
            <li><a title="Logout" href="{{ URL::route('logout') }}"><i class="glyphicon glyphicon-share-alt"></i> <span class="text">{{ trans('usermanager::navigation.logout') }}</span></a></li>
        </ul>
        @endif
    </div>
</div>
