<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Zalo\Zalo;
use Zalo\ZaloEndPoint;


class ZaloController extends Controller
{
    private $zalo;
    private $helper;
    public function __construct()
    {
        $config = array(
            'app_id'=>'2946516192240599353',
            'app_secret'=>'p31sk8862O3VA7z10dCf',
            'callback_url'=>'https://zalo-app-api.herokuapp.com/dashboard'
        );
        $this->zalo = new Zalo($config);
        $this->helper = $this->zalo->getRedirectLoginHelper();
    }
    public function login()
    {
        $callbackUrl = "https://zalo-app-api.herokuapp.com/dashboard";
        $loginUrl = $this->helper->getLoginUrl($callbackUrl);
        return view('login',compact('loginUrl'));
    }
    public function dashboard()
    {
        $callbackUrl = "https://zalo-app-api.herokuapp.com/dashboard";
        $accessToken = $this->helper->getAccessToken($callbackUrl);
        session(['token'=>$accessToken]);
        if(!empty($accessToken))
        {
            $params = ['fields' => 'name,picture'];
            $response = $this->zalo->get(ZaloEndPoint::API_GRAPH_ME, $accessToken, $params);
            $profile = $response->getDecodedBody();
            session(['profile'=>$profile]);
            return view('dashboard',compact('profile'));
        }
        return redirect('/');
    }
    public function friendList()
    {
        $accessToken=session('token');
        $params = ['offset' => 0, 'fields' => "id,name,gender,picture"];
        $response = $this->zalo->get(ZaloEndpoint::API_GRAPH_FRIENDS, $accessToken, $params);
        $result = $response->getDecodedBody();
        $profile = session('profile');
        $total = $result['summary']['total_count'];
        $friends = $result['data'];
        session(['friends'=>$friends]);
        return view('components/friend-list',compact('total','friends','profile'));
    }
    public function inviteList()
    {
        $accessToken=session('token');
        $params = ['offset' => 0, 'fields' => "id,name,gender,picture"];
        $response = $this->zalo->get(ZaloEndpoint::API_GRAPH_INVITABLE_FRIENDS, $accessToken, $params);
        $result = $response->getDecodedBody();
        $profile = session('profile');
        $total = $result['summary']['total_count'];
        $friends = $result['data'];
        session(['invite_friends'=>$friends]);
        return view('components/invite-list',compact('total','friends','profile'));
    }
    public function send(){
        
    }

    public function search($keyword)
    {
        $friends = session('friends');
//        $friends = array_slice($friendList,0,1);
        $html = view('partials.friends')->with(compact('friends'))->render();
        return response()->json(['success' => true, 'html' => $html,'friends'=>$friends]);
    }
    public function profile()
    {
        $profile = session('profile');
        return view('components.profile',compact('profile'));
    }
    public function add($id)
    {
        return view('sendmessage',compact('id'));
    }
    public function sendMessage($id)
    {
        $receives = array();
        $friends = session('friends');
        $profile = session('profile');
        foreach($friends as $friend)
        {
            if($friend['id']==$id)
            {
                array_push($receives,$friend);
            }
        }
        return view('components.send-message',compact('receives','profile'));

    }


}

//$params2 = ['offset' => 0, 'limit' => 10, 'fields' => "id, name,'picture"];
//$response2 = $this->zalo->get(ZaloEndpoint::API_GRAPH_INVITABLE_FRIENDS, $accessToken, $params2);
//$invitable_friends = $response2->getDecodedBody(); // result
//$params3 = ['offset' => 0, 'limit' => 10, 'fields' => "id,name,gender,picture"];
//$response3 = $this->zalo->get(ZaloEndpoint::API_GRAPH_FRIENDS, $accessToken, $params3);
//$friends = $response3->getDecodedBody(); // result
////dd($friends['data'][0]['picture']['data']['url']);
