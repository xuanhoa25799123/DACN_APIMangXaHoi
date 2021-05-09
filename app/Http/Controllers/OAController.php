<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Zalo\Zalo;
use GuzzleHttp;
use Zalo\ZaloEndPoint;

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
        return redirect($linkOAGrantPermission2App);
    }
    public function dashboard(Request $request)
    {
            $oa_token = $request->access_token;
            $oa_id = $request->oa_id;
            session(['oa_token' => $oa_token]);
            session(['oa_id' => $oa_id]);
            $response = $this->zalo->get(ZaloEndPoint::API_OA_GET_PROFILE, $oa_token, []);
            $result = $response->getDecodedBody();
            $oa_info = $result['data'];
            session(['oa_info' => $oa_info]);
             $title="Trang chủ";
             return view('oa.dashboard', compact('oa_info','title'));

    }
    public function home()
    {
        $oa_info = session('oa_info');
        if(empty($oa_info))
        {
            $this->getToken();
        }
        else {
            $title = "Trang chủ";
            return view('oa.dashboard', compact('oa_info', 'title'));
        }
    }
    public function followersList()
    {
        $accessToken = session('oa_token');
        $data = ['data' => json_encode(array(
            'offset' => 0,
            'count' => 10
        ))];
        $response = $this->zalo->get(ZaloEndPoint::API_OA_GET_LIST_FOLLOWER, $accessToken, $data);
        $result = $response->getDecodedBody();
        $follower_ids = $result['data']['followers'];
        $followers = array();
        foreach($follower_ids as $follower) {
            $data = ['data' => json_encode(array(
                'user_id' => $follower['user_id']
            ))];
            $response = $this->zalo->get(ZaloEndpoint::API_OA_GET_USER_PROFILE, $accessToken, $data);
            $result = $response->getDecodedBody(); // result
            array_push($followers,$result['data']);
        }
        $oa_info = session('oa_info');
        $title="Người theo dõi";
        return view('oa.components.followers',compact('followers','oa_info','title'));
    }
    public function articleList()
    {
        $client = new GuzzleHttp\Client();
        $accessToken = session('oa_token');
        $res = $client->get('https://openapi.zalo.me/v2.0/article/getslice?offset=0&type=normal&access_token='.$accessToken);
       $result = json_decode($res->getBody());
       $data = $result->data;
       $articles = $data->medias;
        $oa_info = session('oa_info');
        $title="Bài viết";

       return view('oa.components.articles',compact('articles','oa_info','title'));
    }
    public function selectArticle()
    {
        $oa_info = session('oa_info');
        $title="Chọn bài viết";
        return view('oa.components.article-select',compact('oa_info','title'));
    }
    public function createTextArticle()
    {
        $oa_info = session('oa_info');
        $title="Tạo bài viết văn bản";
        return view('oa.components.create-text-article',compact('oa_info','title'));
    }
    public function createVideoArticle()
    {
        $oa_info = session('oa_info');
        $title="Tạo bài viết video";
        return view('oa.components.create-video-article',compact('oa_info','title'));
    }
}
