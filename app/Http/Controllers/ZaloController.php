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
    public function send(Request $request,$sendIds){
        $accessToken = session('token');
        $params = ['message' => $request->message, 'to' => $sendIds, 'link' => $request->link];
        $response = $this->zalo->post(ZaloEndpoint::API_GRAPH_MESSAGE, $accessToken, $params);
        $result = $response->getDecodedBody(); // result
        dd($result);
    }

    public function search($keyword)
    {
        $frs = session('friends');
        $friends = array();
        if($keyword=="")
        {
            $friends=$frs;
        }
        else {
            foreach ($frs as $fr) {
                if (stripos($fr['name'], $keyword) >= 0) {
                    array_push($friends, $fr);
                }
            }
        }
//        $friends = array_slice($friends,0,1);
        $html = view('partials.friends')->with(compact('friends'))->render();
        return response()->json(['success' => true, 'html' => $html]);
    }
    public function profile()
    {
        $profile = session('profile');
        return view('components.profile',compact('profile'));
    }
    public function sendMessage($id)
    {
        $receives = array();
        $friends = session('friends');
        $profile = session('profile');
        $sendIds = "";
        foreach($friends as $friend)
        {
            if($friend['id']==$id)
            {
                $sendIds.=$friend['id'].',';
                array_push($receives,$friend);
            }
        }
        $sendIds=substr($sendIds,0,-1);
        return view('components.send-message',compact('receives','profile','sendIds'));
    }
    public function sendInvite($id)
    {
        $receives = array();
        $friends = session('invite_friends');
        $profile = session('profile');
        $sendIds = "";
        foreach($friends as $friend)
        {
            if($friend['id']==$id)
            {
                $sendIds.=$friend['id'].',';
                array_push($receives,$friend);
            }
        }
        $sendIds=substr($sendIds,0,-1);
        return view('components.send-invite',compact('receives','profile','sendIds'));
    }
    public function invite(Request $request,$sendIds){
        $accessToken = session('token');
        $params = ['message' => $request->message, 'to' => $sendIds];
        $response = $this->zalo->post(ZaloEndpoint::API_GRAPH_APP_REQUESTS, $accessToken, $params);
        $result = $response->getDecodedBody(); // result
        dd($result);
    }
    public function makeStatus()
    {
        $profile = session('profile');
        return view('components.post-status',compact('profile'));
    }
    public function postStatus(Request $request)
    {
        $accessToken = session('token');
        $params = ['message' => $request->message, 'link' => $request->link];
        $response = $this->zalo->post(ZaloEndpoint::API_GRAPH_POST_FEED, $accessToken, $params);
        $result = $response->getDecodedBody(); // result
        dd($result);
    }
}

//$params2 = ['offset' => 0, 'limit' => 10, 'fields' => "id, name,'picture"];
//$response2 = $this->zalo->get(ZaloEndpoint::API_GRAPH_INVITABLE_FRIENDS, $accessToken, $params2);
//$invitable_friends = $response2->getDecodedBody(); // result
//$params3 = ['offset' => 0, 'limit' => 10, 'fields' => "id,name,gender,picture"];
//$response3 = $this->zalo->get(ZaloEndpoint::API_GRAPH_FRIENDS, $accessToken, $params3);
//$friends = $response3->getDecodedBody(); // result
////dd($friends['data'][0]['picture']['data']['url']);
