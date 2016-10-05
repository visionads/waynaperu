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
    private static function _facebookInstance()
    {

        @session_start();
        $config = [
            'app_id' => '578559572350898',
            'app_secret' => '29ac70c7792546ea7273bbf1c576045d',
            'default_graph_version' => 'v2.6',
            'persistent_data_handler'=>'session'
        ];
        return new Facebook($config);
    }
    public function facebook_login($from=false)
    {
        Session::put('facebook_return_url',$from);
        $fb = SocialMediaController::_facebookInstance();
        $helper = $fb->getRedirectLoginHelper();
        // Optional permissions
        $permissions=Config::get('settingData.permissions');
        $callback='http://exploor.dev/facebook';
        $callback= url($callback);
        $url=$helper->getLoginUrl($callback, ['public_profile','email']);
        return Redirect::to($url);
    }

    public static function fb_return()
    {
        $return=SocialMediaController::_return();
        if(isset($return['profile']))
        {
            $user=User::where('facebook_id',$return['profile']['id'])->first();
            if(count($user) !=1)
            {
                $user=User::where('email',$return['profile']['email'])->first();
                if(count($user) != 1) {
                    $user = new User();
                    $user->first_name = $return['profile']['name'];
                    $user->email = $return['profile']['email'];
                    $user->facebook_id = $return['profile']['id'];
                    $user->save();
                }else{
                    $user->facebook_id = $return['profile']['id'];
                    $user->save();
                }
            }
            Auth::login($user);

            Session::flash('success', "Successfully login via Facebook");
            if(Session::get('facebook_return_url')=='checkout' && Auth::user()->type=='client')
            {
                Session::forget('facebook_return_url');
                return Redirect::route('login_checkout');
            }elseif(Auth::user()->type=='client')
            {
                return Redirect::route('account');
            }elseif(Auth::user()->type=='admin')
            {
                return Redirect::route('admin');
            }
        }
    }
    private static function _return()
    {
        $fb = SocialMediaController::_facebookInstance();
        $helper = $fb->getRedirectLoginHelper();
        try {
            $accessToken = $helper->getAccessToken();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            return $e->getMessage();
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            return $e->getMessage();
        }

//        $oAuth2Client= $fb->getOAuth2Client();
//        $data['longLiveAccessToken']=$oAuth2Client->getLongLivedAccessToken($accessToken);
        $fb->setDefaultAccessToken($accessToken);

        try {
            $response = $fb->get('/me?fields=id,name,email');
            $profile['profile'] = $response->getGraphUser();
            return $profile;
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            return $e->getMessage();
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            return $e->getMessage();
        }
    }
}