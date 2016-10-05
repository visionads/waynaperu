<?php

/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 10/4/16
 * Time: 4:01 PM
 */
use Facebook\Facebook;
class SocialMediaController extends BaseController
{
    public function facebook_login()
    {
        @session_start();
        $config = [
            'app_id' => '578559572350898',
            'app_secret' => '29ac70c7792546ea7273bbf1c576045d',
            'default_graph_version' => 'v2.6',
            'persistent_data_handler'=>'session'
        ];
        $fb = new Facebook($config);
        $helper = $fb->getRedirectLoginHelper();
        // Optional permissions
        $permissions=Config::get('settingData.permissions');
        $callback='http://exploor.com/waynaperu/public_html/en/facebook/';
        $callback= url($callback);
        $url=$helper->getLoginUrl($callback, ['public_profile']);
        return Redirect::to($url);
        dd($url);
    }
}