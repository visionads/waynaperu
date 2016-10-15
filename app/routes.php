<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
use \AdamWathan\EloquentOAuth\Exceptions\ApplicationRejectedException;
use \AdamWathan\EloquentOAuth\Exceptions\InvalidAuthorizationCodeException;

Route::group(['prefix' => LaravelLocalization::setLocale(), 'before' => 'LaravelLocalizationRedirectFilter'], function()
{
// admin login route
Route::get('admin_login', array('as' => 'admin-login', 'uses' => 'UsersController@admin_login'));
Route::post('admin_login', array('as' => 'admin-login', 'uses' => 'UsersController@admin_login_check'));


// Facebook routes
Route::get('facebook/login/{from?}',['as'=>'facebook_login','uses'=>'SocialMediaController@facebook_login']);
Route::get('facebook', array('as' => 'facebook', 'uses' => 'SocialMediaController@fb_return'));

// Admin Routes
Route::group(array('before' => 'adminFilter'), function () {
    Route::get('create_child',function (){
        $products=Product::select('id')->get();
//        dd($products);
        foreach ($products as $product)
        {
//            dd($product->id);
            for($i=1;$i<=2;$i++) {
                $product_info = new ProductInfo();
                $product_info->language_id = $i;
                $product_info->product_id = $product->id;
                $product_info->save();
            }
            echo $product->id.' Done <br>';
        }
        exit('Success');
    });
    Route::get('admin',['as'=>'admin','uses'=>'DashboardController@index']);

    Route::get('users/{type}',['as'=>'users','uses'=>'UserController@index']);
    Route::get('user/add',['as'=>'add-user','uses'=>'UserController@create']);
    Route::post('user/store',['as'=>'store-user','uses'=>'UserController@store']);
    Route::get('user/edit/{user_id}',['as'=>'edit-user','uses'=>'UserController@edit']);
    Route::post('user/update/{user_id}',['as'=>'update-user','uses'=>'UserController@update']);
    Route::get('user/delete/{user_id}',['as'=>'delete-user','uses'=>'UserController@destroy']);
    Route::get('user/edit_profile/{user_id}',['as'=>'edit-profile','uses'=>'UserController@edit_profile']);
    Route::post('user/update_profile/{user_id}',['as'=>'update-profile','uses'=>'UserController@update_profile']);
    Route::get('user/activity/{user_id?}',['as'=>'user-activity','uses'=>'UserController@activity']);
    // phone routes
    Route::get('user/add_phone/{user_id}',['as'=>'add-phone','uses'=>'UserController@add_phone']);
    Route::post('user/store_phone_number/{user_id}',['as'=>'store-phone-number','uses'=>'UserController@store_phone_number']);
    Route::get('user/edit_phone/{id}',['as'=>'edit-phone','uses'=>'UserController@edit_phone']);
    Route::post('user/update_phone_number/{user_id}',['as'=>'update-phone-number','uses'=>'UserController@update_phone_number']);
    Route::get('user/delete_phone/{id}',['as'=>'delete-phone','uses'=>'UserController@delete_phone']);
    // Bank routes
    Route::get('user/add_bank/{user_id}',['as'=>'add-bank','uses'=>'UserController@add_bank']);
    Route::post('user/store_bank/{user_id}',['as'=>'store-bank','uses'=>'UserController@store_bank']);
    Route::get('user/edit_bank/{id}',['as'=>'edit-bank','uses'=>'UserController@edit_bank']);
    Route::post('user/update_bank/{id}',['as'=>'update-bank','uses'=>'UserController@update_bank']);
    Route::get('user/delete_bank/{id}',['as'=>'delete-bank','uses'=>'UserController@delete_bank']);
    // Bank routes
    Route::get('user/add_additional_info/{user_id}',['as'=>'add-additional-info','uses'=>'UserController@add_additional_info']);

    Route::post('user/update_provider_info/{user_id}',['as'=>'update_provider_info','uses'=>'UserController@update_provider_info']);
    Route::post('user/update_client_info/{user_id}',['as'=>'update_client_info','uses'=>'UserController@update_client_info']);


    /* == User/provider Information ==  */
    Route::get('profile/{user_id?}',['as'=>'user-profile','uses'=>'UserController@profile']);
    Route::get('products/provider/{user_id?}',['as'=>'products-provider','uses'=>'ProductController@product_per_provider']);
    Route::get('orders/provider/{user_id?}',['as'=>'orders-provider','uses'=>'OrdersController@orders_per_provider']);



    Route::controller('filemanager', 'FilemanagerLaravelController');
	//Languages
	Route::get('/admin/languages','LanguagesController@index');
	Route::get('admin/add_language','LanguagesController@add_language');
	Route::post('admin/save_language','LanguagesController@save_language');
	Route::get('admin/edit_language/{id}','LanguagesController@edit_language');
	Route::post('admin/update_language','LanguagesController@update_language');
	Route::get('admin/delete_language','LanguagesController@delete_language');

	// Language File Editor
	Route::get('admin/language-file-en','LanguagesController@en_language');
	Route::post('admin/language-file-en-save','LanguagesController@en_language_save');
	Route::get('admin/language-file-fr','LanguagesController@fr_language');
	Route::post('admin/language-file-fr-save','LanguagesController@fr_language_save');
	Route::get('admin/language-file-es','LanguagesController@es_language');
	Route::post('admin/language-file-es-save','LanguagesController@es_language_save');

	//Content
	Route::get('admin/pages', array('as' => 'list_pages', 'uses' => 'PagesController@listPages'));
	Route::get('admin/page/add', array('as' => 'add_page', 'uses' => 'PagesController@addPage'));
	Route::post('admin/page/add', array('as' => 'save_add_page', 'uses' => 'PagesController@savePage'));
	Route::get('admin/page/edit/{id}', array('as' => 'edit_page', 'uses' => 'PagesController@editPage'));
	Route::post('admin/page/edit/{id}', array('as' => 'save_edit_page', 'uses' => 'PagesController@saveEditPage'));
	// Route::get('admin/page/delete/{id}', array('as' => 'delete_page', 'uses' => 'PagesController@deletePage'));
	Route::get('admin/page/del', 'PagesController@delete');

	//Categories
	Route::any('admin/categories','CategoryController@index');
	Route::any('admin/category/add','CategoryController@add');
	Route::post('admin/category/save','CategoryController@save');
	Route::get('admin/category/edit/{id}','CategoryController@edit');
	Route::post('admin/category/update/{id}','CategoryController@update');
	Route::get('admin/category/delete','CategoryController@delete');

	//product management
    Route::get('admin/products', array('as' => 'list_products', 'uses' => 'ProductController@index'));
    Route::get('admin/product/add', array('as' => 'add_product', 'uses' => 'ProductController@add'));
    Route::post('admin/product/save', array('as' => 'save_product', 'uses' => 'ProductController@save'));
    Route::get('admin/product/edit/{id}', array('as' => 'edit_product', 'uses' => 'ProductController@edit'));
    Route::post('admin/product/update/{id}', array('as' => 'update_product', 'uses' => 'ProductController@update'));
    Route::any('admin/product/delete', array('as' => 'delete_product', 'uses' => 'ProductController@delete'));
    Route::get('admin/delete/image/{id}', array('as' => 'delete_image', 'uses' => 'ProductController@delete_image')); 

    //Product Locations
    Route::get('admin/{id}/locations', array('as' => 'list_locations', 'uses' => 'LocationController@index'));
    Route::get('admin/location/add', array('as' => 'add_location', 'uses' => 'LocationController@add'));
    Route::post('admin/location/save', array('as' => 'save_location', 'uses' => 'LocationController@save'));
    Route::get('admin/location/{pid}/edit/{id}', array('as' => 'edit_location', 'uses' => 'LocationController@edit'));
    Route::post('admin/location/update', array('as' => 'update_location', 'uses' => 'LocationController@update'));
    Route::any('admin/{pid}/locations/delete', array('as' => 'delete_location', 'uses' => 'LocationController@delete'));

    //Faq
	Route::get('admin/faqs', array('as' => 'list_faqs', 'uses' => 'FaqController@index'));
	Route::get('admin/faq/add', array('as' => 'add_faq', 'uses' => 'FaqController@add'));
	Route::post('admin/faq/add', array('as' => 'save_add_faq', 'uses' => 'FaqController@save'));
	Route::get('admin/faq/edit/{id}', array('as' => 'edit_faq', 'uses' => 'FaqController@edit'));
	Route::post('admin/faq/edit/{id}', array('as' => 'save_edit_faq', 'uses' => 'FaqController@update'));
	Route::get('admin/faq/del', 'FaqController@delete');

	//Product FAQ's
    Route::get('admin/{id}/efaqs', array('as' => 'list_efaqs', 'uses' => 'FaqController@efaqindex'));
    Route::get('admin/efaq/add', array('as' => 'add_efaq', 'uses' => 'FaqController@efaqadd'));
    Route::post('admin/efaq/save', array('as' => 'save_efaq', 'uses' => 'FaqController@efaqsave'));
    Route::get('admin/efaq/{pid}/edit/{id}', array('as' => 'edit_efaq', 'uses' => 'FaqController@efaqedit'));
    Route::post('admin/efaq/update', array('as' => 'update_efaq', 'uses' => 'FaqController@efaqupdate'));
    Route::any('admin/{pid}/efaq/delete', array('as' => 'delete_efaq', 'uses' => 'FaqController@efaqdelete'));

    //Districts
    Route::any('admin/districts','DistrictsController@index');
	Route::any('admin/district/add','DistrictsController@add');
	Route::post('admin/district/save','DistrictsController@save');
	Route::get('admin/district/edit/{id}','DistrictsController@edit');
	Route::post('admin/district/update/{id}','DistrictsController@update');
	Route::get('admin/district/delete','DistrictsController@delete');

	//Order Management
	Route::get('admin/orders', array('as' => 'orders', 'uses' => 'OrdersController@index'));
	Route::get('admin/order/{id}', array('as' => 'edit_order', 'uses' => 'OrdersController@edit'));
	Route::post('admin/order/update', array('as' => 'update_order', 'uses' => 'OrdersController@update'));

    //Slider Manager
    Route::get('admin/slider',['as'=>'slider','uses'=>'SliderController@index']);
    Route::get('admin/slider/add',['as'=>'add_slide','uses'=>'SliderController@create']);
    Route::post('admin/slider/store',['as'=>'store_slide','uses'=>'SliderController@store']);
    Route::get('admin/slider/edit/{id}',['as'=>'edit_slide','uses'=>'SliderController@edit']);
    Route::post('admin/slider/update',['as'=>'update_slide','uses'=>'SliderController@update']);
    Route::get('admin/slider/change_status/{status}/{id}',['as'=>'change_slide_status','uses'=>'SliderController@change_status']);
    Route::get('admin/slider/delete/{id}',['as'=>'delete_slide','uses'=>'SliderController@destroy']);

});
//
//Route::group(['prefix' => LaravelLocalization::setLocale(), 'before' => 'LaravelLocalizationRedirectFilter'], function()
//{
	// root route of this site
	Route::get('/', array('as' => 'home', 'uses' => 'HomeController@showWelcome'));
    // clients orders
    Route::get('orders',['as'=>'orders','uses'=>'OrdersController@orders']);
    Route::get('order/{order_id}',['as'=>'order-details','uses'=>'OrdersController@order_details']);

    Route::post('newsletter', array('as' => 'newsletter', 'uses' => 'CampaignController@newsletter'));
	// admin login route here
	Route::post('client_login', array('as' => 'client-login', 'uses' => 'UsersController@client_login_check'));
	Route::post('client_login_checkout', array('as' => 'client-login-checkout', 'uses' => 'UsersController@client_login_check_checkout'));
	Route::post('login', array('as' => 'post_login', 'uses' => 'UsersController@postLogin'));
	Route::post('register', array('as' => 'post_register', 'uses' => 'UsersController@postRegister'));
	Route::get('logout', array('as' => 'site_logout', 'uses' => 'UsersController@logout'));
	Route::get('account', array('as' => 'account', 'uses' => 'UsersController@getAccount'));
	Route::post('account', array('as' => 'save_account', 'uses' => 'UsersController@postAccount'));
	Route::get('agente-bcp/{order}', array('as' => 'agente_bcp', 'uses' => 'CartController@agenteBCP'));
	Route::any('order/success/{order}', array('as' => 'order_success', 'uses' => 'CartController@showOrderSuccess'));
	// Route::get('category/{id}', array('as' => 'category', 'uses' => 'HomeController@showCategory'));
	// Route::get('experience/{id}', array('as' => 'experience', 'uses' => 'ExperienceController@showExp'));
	Route::get('{category}/{id}', array('as' => 'category', 'uses' => 'HomeController@showCategory'));
	Route::get('{category}/{experience}/{id}', array('as' => 'category_experience_id', 'uses' => 'ExperienceController@show'));
	Route::post('contact_provider', array('as' => 'contact_provider', 'uses' => 'ExperienceController@contactProvider'));
	Route::get('getlocdata', array('as' => 'getlocdata', 'uses' => 'ExperienceController@getLocData'));
	Route::get('search', array('as' => 'search', 'uses' => 'HomeController@showSearch'));
	Route::get('special/{special}', array('as' => 'special', 'uses' => 'HomeController@showSpecial'));
	Route::any('filter', array('as' => 'filter', 'uses' => 'HomeController@showFilter'));
	Route::any('autosearch', array('as' => 'autosearch', 'uses' => 'HomeController@showAutoSearch'));
	Route::any('remove', array('as' => 'remove_row', 'uses' => 'HomeController@removeRow'));
	Route::any('terms-n-conditions', array('as' => 'terms_n_conditions', 'uses' => 'HomeController@termsConditions'));
	Route::any('faq', array('as' => 'faq_front', 'uses' => 'HomeController@faq'));
    Route::any('how-does-wayna-work', array('as' => 'wayna_work', 'uses' => 'HomeController@wayna_work'));

	Route::post('add', array('as' => 'product_add', 'uses' => 'CartController@add'));
	Route::get('cart', array('as' => 'cart', 'uses' => 'CartController@showCart'));
	Route::any('updatecart', array('as' => 'updatecart', 'uses' => 'CartController@update'));
	Route::get('login-checkout', array('as' => 'login_checkout', 'uses' => 'CartController@showLoginCheckout'));
	Route::post('process-login-checkout', array('as' => 'process_login_checkout', 'uses' => 'CartController@processLoginCheckout'));
	Route::post('process-guest-checkout', array('as' => 'process_guest_checkout', 'uses' => 'CartController@processGuestCheckout'));
	Route::get('checkout', array('as' => 'checkout', 'uses' => 'CartController@showCheckout'));
	Route::post('process-checkout', array('as' => 'process_checkout', 'uses' => 'CartController@processCheckout'));
	Route::get('culqi/{order}', array('as' => 'culqi', 'uses' => 'CartController@culqi'));
	Route::any('culqi-ipn', array('as' => 'culqi_ipn', 'uses' => 'CartController@culqiIPN'));

    Route::post('update-account', array('as' => 'update_account', 'uses' => 'CartController@update_account'));

    Route::get('facebook/authorize', function() {
	    return OAuth::authorize('facebook');
	});

	Route::get('google/authorize', function() {
	    return OAuth::authorize('google');
	});

//	Route::get('facebook/login', function() {
//		if(Input::has('error')){
//			 return Redirect::intended();
//		}
//	    try {
//
//	        OAuth::login('facebook', function($user, $details) {
//			    $user->email = $details->email;
//			    $user->first_name = $details->nickname;
//			    $user->username = 'facebook-'.$details->email;
//			    $user->save();
//			});
//	    } catch (ApplicationRejectedException $e) {
//	        // User rejected application
//	        return Redirect::intended();
//	    } catch (InvalidAuthorizationCodeException $e) {
//	        // Authorization was attempted with invalid
//	        // code,likely forgery attempt
//	        return Redirect::intended();
//	    }
//
//	    // Current user is now available via Auth facade
//	    $user = Auth::user();
//
//	    return Redirect::intended();
//	});

	Route::get('google/login', function() {
		if(Input::has('error')){
			 return Redirect::intended();
		}
	    try {
	       
	        OAuth::login('google', function($user, $details) {
			    $user->email = $details->email;
			    $user->first_name = $details->nickname;
			    $user->username = 'google-'.$details->email;
			    $user->save();
			});
	    } catch (ApplicationRejectedException $e) {
	        // User rejected application
	        return Redirect::intended();
	    } catch (InvalidAuthorizationCodeException $e) {
	        // Authorization was attempted with invalid
	        // code,likely forgery attempt
	        return Redirect::intended();
	    }

	    // Current user is now available via Auth facade
	    $user = Auth::user();

	    return Redirect::intended();
	});

});
