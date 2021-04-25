<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OAController extends Controller
{
    private $zalo;
    private $helper;
    public function __construct()
    {

        $config = array(
            'app_id'=>'2946516192240599353',
            'app_secret'=>'p31sk8862O3VA7z10dCf',
            'callback_url'=>'https://laravel-api-social.herokuapp.com/dashboard'
        );
        $this->zalo = new Zalo($config);
        $this->helper = $this->zalo->getRedirectLoginHelper();
    }
    public function getToken()
    {
        $callbackPageUrl = "https://zalo-app-api.herokuapp.com/oa/dashboard";
        $linkOAGrantPermission2App = $this->helper->getLoginUrlByPage($callbackPageUrl);
    }
}
