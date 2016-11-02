<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});


/*
 * package auth
 * */

Route::filter('adminFilter', function () {
    if(!Auth::check()) {
            return Redirect::to('/');
    }
    if (Auth::user()->type != 'admin' && Auth::user()->type != 'provider') {
            return Redirect::to('/');

    }
        View::share('currentUser', Sentry::getUser());
});
Route::filter('clientFilter', function () {
    if(Auth::check() && Auth::user()->type!='client'){

        return Redirect::route('home');
    }
        View::share('currentUser', Sentry::getUser());
});

Route::filter('basicAuth', function () {
    if(!Sentry::check()) {
        // save the attempted url
        Session::put('attemptedUrl', URL::current());

        return Redirect::route('getLogin');
    }

//    View::share('currentUser', Sentry::getUser());
});

Route::filter('notAuth', function () {
    if(Sentry::check()) {
        $url = Session::get('attemptedUrl');
        if(!isset($url)) {
            $url = URL::route('indexDashboard');
        }
        Session::forget('attemptedUrl');

        return Redirect::to($url);
    }
});

Route::filter('hasPermissions', function ($route, $request, $userPermission = null) {
    if (
        Route::currentRouteNamed('putUser') && Sentry::getUser()->id == Request::segment(3)
        ||
        Route::currentRouteNamed('showUser') && Sentry::getUser()->id == Request::segment(3)
    ) {
    } else {
        if($userPermission === null) {
            $permissions = Config::get('usermanager::permissions');
            $permission = $permissions[Route::current()->getName()];
        } else {
            $permission = $userPermission;
        }

        if(!Sentry::getUser()->hasAccess($permission)) {
            return App::abort(403);
        }
    }
});

//App::error(function (Exception $exception, $code) {
//    View::share('currentUser', Sentry::getUser());
//
//    $exceptionMessage = $exception->getMessage();
//    $message = !empty($exceptionMessage) ? $exceptionMessage : Lang::trans('usermanager::all.messages.error.403');
//
//    if(403 === $code) {
//        return Response::view(
//            Config::get('usermanager::views.error'),
//            array(
//                'message' => $message,
//                'code'=>$code,
//                'title'=>Lang::trans('usermanager::all.messages.error.403-title')
//            )
//        );
//    }

//    if(App::environment('production') || !Config::get('app.debug')) {
//        switch ($code) {
//            case 404:
//                return Response::view(
//                    Config::get('usermanager::views.error'),
//                    array(
//                        'message' => Lang::trans('usermanager::all.messages.error.404'),
//                        'code'=>$code,
//                        'title'=>Lang::trans('usermanager::all.messages.error.404-title')
//                    )
//                );
//
//            case 500:
//                return Response::view(
//                    Config::get('usermanager::views.error'),
//                    array(
//                        'message' => Lang::trans('usermanager::all.messages.error.500'),
//                        'code'=>$code,
//                        'title'=>Lang::trans('usermanager::all.messages.error.500-title')
//                    )
//                );
//
//            default:
//                return Response::view(
//                    Config::get('usermanager::views.error'),
//                    array(
//                        'message' => Lang::trans('usermanager::all.messages.error.default'),
//                        'code'=>$code,
//                        'title'=>Lang::trans('usermanager::all.messages.error.default-title')
//                    )
//                );
//        }
//    }
//});