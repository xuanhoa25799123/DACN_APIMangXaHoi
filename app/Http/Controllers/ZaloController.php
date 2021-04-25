<?php

namespace App\Http\Controllers;

use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Zalo\Zalo;
use Zalo\ZaloEndPoint;
use Goutte\Client;


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
        $ac = session('token');
        if(!empty($ac))
        {
            $profile = session('profile');
            return view('dashboard',compact('profile'));
        }
        else {
            $callbackUrl = "https://zalo-app-api.herokuapp.com/dashboard";
            $accessToken = $this->helper->getAccessToken($callbackUrl);
            session(['token' => $accessToken]);
            if (!empty($accessToken)) {
                $expires = $accessToken->getExpiresAt();
                $expires = $expires->format('H:i:s');
//                $expires = $expires->format('Y-m-d H:i:s');
                session(['expires'=>$expires]);
//                $current = date('Y-m-d H:i:s');
//                //$remain = new \DateTime($rs)->diff($current)->format("%d");
//                $date1 = new DateTime($rs);
//                $date2 = new DateTime($current);
//                dd($date1,$date2);
                $params = ['fields' => 'name,picture,gender,id,birthday'];
                $response = $this->zalo->get(ZaloEndPoint::API_GRAPH_ME, $accessToken, $params);
                $profile = $response->getDecodedBody();
                session(['profile' => $profile]);
                return view('dashboard', compact('profile','expires'));
            }
        }
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
        return view('components.friend-list',compact('total','friends','profile'));
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
        return view('components.invite-list',compact('total','friends','profile'));
    }
    public function send(Request $request,$sendIds){
        $accessToken = session('token');
        $idArr = explode(',',$sendIds);
        $result=array();
        foreach($idArr as $id) {
            $params = ['message' => $request->message, 'to' => $id, 'link' => $request->link];
            $response = $this->zalo->post(ZaloEndpoint::API_GRAPH_MESSAGE, $accessToken, $params);
            $rs = $response->getDecodedBody(); // result
            array_push($result,$rs['to']);
        }

        return response()->json(['success'=>'true','sendIds'=>$sendIds,'message'=>$request->message,'link'=>$request->link,'result'=>$result]);
    }
    public function friendSearch($keyword)
    {
        $frs = session('friends');
        $friends = array();
        if($keyword=="*")
        {
            $friends = $frs;
        }
        else {
            foreach ($frs as $fr) {
                if (stripos($fr['name'], $keyword) == true||stripos($fr['name'], $keyword) ===0) {
                    array_push($friends, $fr);
                }
            }
        }
        $html = view('partials.friends')->with(compact('friends'))->render();
        return response()->json(['success' => true, 'html' => $html]);
    }
    public function inviteSearch($keyword)
    {
        $frs = session('invite_friends');
        $friends = array();
        if($keyword=="*")
        {
            $friends=$frs;
        }
        else {
            foreach ($frs as $fr) {
                if (stripos($fr['name'], $keyword) == true||stripos($fr['name'], $keyword) ===0) {
                    array_push($friends, $fr);
                }
            }
        }
        $html = view('partials.invite')->with(compact('friends'))->render();
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
        $sendIds=$id;
        $idArr = explode(',',$id);
        foreach($friends as $friend)
        {
            if(in_array($friend['id'],$idArr))
            {
                array_push($receives,$friend);
            }
        }
        $message="";
        $link="";
        return view('components.send-message',compact('receives','profile','sendIds','message','link'));
    }
    public function sendPreview(Request $request)
    {
        $profile = session('profile');
        $message = $request->message;
        $link = $request->link;
        $html = view('partials.send-preview')->with(compact('message','link','profile'))->render();
        return response()->json((['success'=>true,'html'=>$html]));
    }
    public function invitePreview(Request $request)
    {
        $profile = session('profile');
        $message = $request->message;
        $html = view('partials.invite-preview')->with(compact('message','profile'))->render();
        return response()->json((['success'=>true,'html'=>$html]));
    }
    public function statusPreview(Request $request)
    {
        $profile = session('profile');
        $message = $request->message;
        $link = $request->link;
        $html = view('partials.status-preview')->with(compact('message','link','profile'))->render();
        return response()->json((['success'=>true,'html'=>$html]));
    }
    public function sendInvite($id)
    {
        $receives = array();
        $friends = session('invite_friends');
        $profile = session('profile');
        $sendIds=$id;
        $idArr = explode(',',$id);
        foreach($friends as $friend)
        {
            if(in_array($friend['id'],$idArr))
            {
                array_push($receives,$friend);
            }
        }
        $message="";
        return view('components.send-invite',compact('receives','profile','sendIds','message'));
    }
    public function invite(Request $request,$sendIds){
        $accessToken = session('token');
        $params = ['message' => $request->message, 'to' => $sendIds];
        $response = $this->zalo->post(ZaloEndpoint::API_GRAPH_APP_REQUESTS, $accessToken, $params);
        $result = $response->getDecodedBody(); // result
//        $sendArr = explode(',',$sendIds);
//        if(count($sendArr)==count($result['to']))
//        {
//            return response()->json(['success'=>'true','complete'=>true,'count'=>count($result['to'])]);
//        }
//        else{
//            $unsend = "";
//            $count = 0;
//            foreach($sendArr as $item)
//            {
//                if(!in_array($item,$result['to']))
//                {
//                    $count++;
//                    if($unsend=="")
//                    {
//                        $unsend .= $item;
//                    }
//                    else{
//                        $unsend .=','.$item;
//                    }
//                }
//            }
            //return response()->json(['success'=>'true','complete'=>true,'unsend'=>$unsend,'count'=>$count,'result'=>$result]);
        return response()->json(['success'=>'true','complete'=>true,'result'=>$result]);
        //}
    }
    public function makeStatus()
    {
        $profile = session('profile');
        $message="";
        $link="";
        return view('components.post-status',compact('profile','message','link'));
    }
    public function postStatus(Request $request)
    {
        $accessToken = session('token');
        $params = ['message' => $request->message, 'link' => $request->link];
        $response = $this->zalo->post(ZaloEndpoint::API_GRAPH_POST_FEED, $accessToken, $params);
        $result = $response->getDecodedBody(); // result
        dd($result);
    }
    public function extractProcess(Request $request)
    {
        $get_url = $request->url;
        $get_content = file_get_contents($get_url);
        foreach($get_content->find('title') as $element)
        {
            $page_title = $element->plaintext;
        }
        foreach($get_content->find('body') as $element)
        {
            $page_body = trim($element->plaintext);
            $pos=strpos($page_body, ' ', 200); //Find the numeric position to substract
            $page_body = substr($page_body,0,$pos ); //shorten text to 200 chars
        }
        $image_urls = array();
        foreach($get_content->find('img') as $element)
        {
            if(!preg_match('/blank.(.*)/i', $element->src) && filter_var($element->src, FILTER_VALIDATE_URL))
            {
                $image_urls[] =  $element->src;
            }
        }
        return response()->json(['code'=>200,'data'=>['title'=>$page_title, 'images'=>$image_urls, 'content'=> $page_body]]);

    }
    public function previewUrl(Request $request)
    {
        try {
        $content=$request->link;
        $urls = preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $content, $match);
        $results = [];
        if ($urls > 0) {
            $url = $match[0][0];
            $client = new Client();
                $crawler = $client->request('GET', $url);
                $statusCode = $client->getResponse()->getStatusCode();
                if ($statusCode == 200) {
                    $title = $crawler->filter('title')->text();
                    if ($crawler->filterXpath('//meta[@name="description"]')->count()) {
                        $description = $crawler->filterXpath('//meta[@name="description"]')->attr('content');
                    }
                    if ($crawler->filterXpath('//meta[@property="og:image"]')->count()) {
                        $image = $crawler->filterXpath('//meta[@property="og:image"]')->attr('content');
                    }
                    elseif($crawler->filterXpath('//meta[@name="og:image"]')->count()) {
                        $image = $crawler->filterXpath('//meta[@name="og:image"]')->attr('content');
                    }
                    elseif ($crawler->filterXpath('//meta[@name="twitter:image"]')->count()) {
                        $image = $crawler->filterXpath('//meta[@name="twitter:image"]')->attr('content');
                    } else {
                        if ($crawler->filter('img')->count()) {
                            $image = $crawler->filter('img')->attr('src');
                        } else {
                            $image = 'no_image';
                        }
                    }
                    $results['title'] = $title;
                    $results['url'] = $url;
                    $results['host'] = parse_url($url)['host'];
                    $results['description'] = isset($description) ? $description : '';
                    $results['image'] = $image;
                }
            }
            if (count($results) > 0) {
                return response()->json(['success' => true, 'data' => $results]);
            }
            return response()->json(['success' => false, 'data' => $results]);
        }
        catch (\Exception $e) {
            return response()->json(['success' => false, 'data' => $e->getMessage()]);
        }
    }
    public function refreshToken()
    {
        try {
            $callbackUrl = "https://zalo-app-api.herokuapp.com/dashboard";
            $accessToken = $this->helper->getAccessToken($callbackUrl);
            if (!empty($accessToken)) {
                $expires = $accessToken->getExpiresAt();
                $expires = $expires->format('Y-m-d H:i:s');
                session(['expires' => $expires]);
                return Response()->json(['success'=>true,'expires'=>$expires]);
            }
            return Response()->json(['success'=>false,'message'=>'Cannot get access token']);
        }catch(\Exception $e)
        {
            dd($e->getMessage());
        }
    }
}

//$params2 = ['offset' => 0, 'limit' => 10, 'fields' => "id, name,'picture"];
//$response2 = $this->zalo->get(ZaloEndpoint::API_GRAPH_INVITABLE_FRIENDS, $accessToken, $params2);
//$invitable_friends = $response2->getDecodedBody(); // result
//$params3 = ['offset' => 0, 'limit' => 10, 'fields' => "id,name,gender,picture"];
//$response3 = $this->zalo->get(ZaloEndpoint::API_GRAPH_FRIENDS, $accessToken, $params3);
//$friends = $response3->getDecodedBody(); // result
////dd($friends['data'][0]['picture']['data']['url']);
