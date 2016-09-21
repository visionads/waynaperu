<?php

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

ClassLoader::addDirectories(array(

    app_path().'/commands',
    app_path().'/controllers',
    app_path().'/models',
    app_path().'/database/seeds',

));

/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a basic log file setup which creates a single file for logs.
|
*/

Log::useFiles(storage_path().'/logs/laravel.log');

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

App::error(function(Exception $exception, $code)
{
    Log::error($exception);
});

/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenance mode is in effect for the application.
|
*/

App::down(function()
{
    return Response::make("Be right back!", 503);
});

/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

require app_path().'/filters.php';

function convertAmount($amount)
{
    $newAmount = number_format($amount, 2);

    if ( $newAmount < 0.99999 ) {
        $newAmount = substr($newAmount, 1, strlen($newAmount) - 1);
    }

    $newAmount = str_replace(",", "", $newAmount);
    $newAmount = str_replace(".", "", $newAmount);

    return $newAmount;
}

function getLangId($code){
    return DB::table('languages')->where('code','=', $code)->pluck('id');
}

function getLocPrice($product_id){
    $price =  DB::table('locations')->where('product_id','=', $product_id)->pluck('price1');

    if (isset($price)) {
        $price = number_format($price, 2);
        $p = explode(".", $price);
        return "<span>S/.</span>".$p[0] .".<span>".$p[1]."</span>";
        /*
        $price = number_format((float) $price, 2);
        $p = explode(".", $price);
    	return "<span>S/.</span>".$p[0] .".<span>".$p[1]."</span>";
        */
        # code...
    }else{
        return '<span>N/A</span>';
    }
}
function getLocPrice2($product_id){
    $price =  DB::table('locations')->where('product_id','=', $product_id)->pluck('price2');

    if (isset($price)) {
        $price = number_format($price, 2);
        $p = explode(".", $price);
        return "<span>S/.</span>".$p[0] .".<span>".$p[1]."</span>";
        /*
        $price = number_format((float) $price, 2);
        $p = explode(".", $price);
    	return "<span>S/.</span>".$p[0] .".<span>".$p[1]."</span>";
        */
        # code...
    }else{
        return '<span>N/A</span>';
    }
}

function getLocPriceFresh($product_id){
    $price =  DB::table('locations')->where('product_id','=', $product_id)->pluck('price1');

    if (isset($price)) {
        return number_format($price, 2);
    }else{
        return 0;
    }
}
function getLocPrice2Fresh($product_id){
    $price =  DB::table('locations')->where('product_id','=', $product_id)->pluck('price2');

    if (isset($price)) {
        return number_format($price, 2);
    }else{
        return 0;
    }
}

function getLocPriceOrder($product_id){
    $price =  DB::table('locations')->where('product_id','=', $product_id)->pluck('price1');

    if (isset($price)) {
        $price = number_format($price, 2);
        return $price;
        /*
        $price = number_format((float) $price, 2);
        return $price;
        */
        # code...
    }else{
        return '0';
    }
}

function getProductHits($product_id){
    $hits =  DB::table('products')->where('id','=', $product_id)->pluck('hits');

    if (isset($hits)) {

        return $hits;
        # code...
    }else{
        return '0';
    }
}

function getLocationName($product_id){
    $lang_code = LaravelLocalization::getCurrentLocale();
    $language_id    = getLangId($lang_code);
    $name =  DB::table('location_content')
        ->join('locations', 'location_content.loc_id', '=', 'locations.id')
        ->where('location_content.lang_id','=', $language_id)
        ->where('locations.product_id','=', $product_id)
        ->pluck('name');

    return $name;
}

function getLocName($loc_id){
    $lang_code = LaravelLocalization::getCurrentLocale();
    $language_id    = getLangId($lang_code);
    $name =  DB::table('location_content')
        ->join('locations', 'location_content.loc_id', '=', 'locations.id')
        ->where('location_content.lang_id','=', $language_id)
        ->where('locations.id','=', $loc_id)
        ->pluck('name');

    return $name;
}

function getLocCount($product_id){
    return  DB::table('locations')->where('product_id','=', $product_id)->count();

}

function getExpName($product_id){
    $lang_code = LaravelLocalization::getCurrentLocale();
    $language_id    = getLangId($lang_code);
    return  DB::table('product_content')->where('product_id','=', $product_id)->where('lang_id','=', $language_id)->pluck('title');

}

function getExpDesc($product_id){
    $lang_code = LaravelLocalization::getCurrentLocale();
    $language_id    = getLangId($lang_code);
    return  DB::table('product_content')->where('product_id','=', $product_id)->where('lang_id','=', $language_id)->pluck('description');

}

// Locatrion Prices
function getPdfPrice($id, $qty, $decimal = true){
    $price  = DB::table('locations')->where('id','=', $id)->pluck('price1');
    $price = number_format($price * $qty, 2);

    return $price;
}

function getPdfPriceWithoutDecimal($id, $qty, $decimal = true){
    $price  = DB::table('locations')->where('id','=', $id)->pluck('price1');
    $price  = $price * $qty;

    return $price;
}

function getMailPrice($id, $qty){
    $price  = DB::table('locations')->where('id','=', $id)->pluck('price2');
    //$price  = $price * $qty;
    $price = number_format($price * $qty, 2);
    return $price;
}

function getGiftPrice($id, $qty){
    $price  = DB::table('locations')->where('id','=', $id)->pluck('price3');
    //$price  = $price * $qty;
    $price = number_format($price * $qty, 2);
    return $price;
}

// Location Image
function getLocImage($location_id){
    $img =  DB::table('product_images')
        ->join('locations', 'product_images.product_id', '=', 'locations.product_id')
        ->where('locations.id', '=', $location_id)
        ->pluck('product_images.image');

    return $img;
}
// Product Icon
function getProIcon($product_id){
    // $id =  DB::table('products')
    //          ->join('locations', 'products.id', '=', 'locations.product_id')
    //          // ->join('categories', 'products.product_id', '=', 'locations.product_id')
    //          ->where('locations.id', '=', $location_id)
    //          ->pluck('products.id');

    $icon = DB::table('categories')
        ->join('products', 'categories.id', '=', 'products.cat_id')
        ->where('products.id', '=', $product_id)
        ->pluck('categories.proicon');

    return $icon;
}

// Location Image
function getExpImage($product_id){
    $img =  DB::table('product_images')
        ->join('products', 'product_images.product_id', '=', 'products.id')
        ->where('products.id', '=', $product_id)
        ->pluck('product_images.image');

    return $img;
}

// Product Mini Description
function getMiniDes($id){
    $lang_code = LaravelLocalization::getCurrentLocale();
    $language_id    = getLangId($lang_code);
    $des =  DB::table('product_content')
        ->join('products', 'product_content.product_id', '=', 'products.id')
        ->where('products.id', '=', $id)
        ->where('product_content.lang_id','=', $language_id)
        ->pluck('product_content.mini_description');

    return $des;
}


function getDisttName($id){
    return  DB::table('districts')->where('id','=', $id)->pluck('name');

}

function getCatName($cat_id){
    $lang_code = LaravelLocalization::getCurrentLocale();
    $language_id    = getLangId($lang_code);
    $title =  DB::table('category_content')
        ->join('categories', 'category_content.cat_id', '=', 'categories.id')
        ->where('category_content.lang_id','=', $language_id)
        ->where('categories.id','=', $cat_id)
        ->pluck('title');

    return $title;
}

function getUserInfo($user_id){
    return  DB::table('users')->where('id','=', $user_id)->first();

}

function getToWhom($to_whom_str, $to_whom_val){
    if (strpos($to_whom_str, $to_whom_val) !== false) {
        return 'checked';
    }else{
        return false;
    }
}

function getToWhomClass($to_whom_str, $to_whom_val){
    if (strpos($to_whom_str, $to_whom_val) !== false) {
        return 'active';
    }else{
        return false;
    }
}

function getSpecial($special_str, $special_val){
    if (strpos($special_str, $special_val) !== false) {
        return 'checked';
    }else{
        return false;
    }
}

function getSpecialClass($special_str, $special_val){
    if (strpos($special_str, $special_val) !== false) {
        return 'active';
    }else{
        return false;
    }
}

function getFaqQue($id){
    $lang_code = LaravelLocalization::getCurrentLocale();
    $language_id    = getLangId($lang_code);
    return  DB::table('faqcontents')->where('faq_id','=', $id)
        ->where('faqcontents.lang_id','=', $language_id)
        ->pluck('que');
}

function getFaqAns($id){
    $lang_code = LaravelLocalization::getCurrentLocale();
    $language_id    = getLangId($lang_code);
    return  DB::table('faqcontents')->where('faq_id','=', $id)
        ->where('faqcontents.lang_id','=', $language_id)
        ->pluck('ans');

}
