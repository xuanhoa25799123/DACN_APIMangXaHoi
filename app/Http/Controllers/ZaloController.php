<?php

namespace App\Http\Controllers;

use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;
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
        return view('social.login',compact('loginUrl'));
    }
    public function dashboard()
    {
        $ac = session('token');
        if(!empty($ac))
        {
            $profile = session('profile');
            $title="Trang chủ";
            return view('social.dashboard',compact('profile','title'));
        }
        else {
            $callbackUrl = "https://zalo-app-api.herokuapp.com/dashboard";
            $accessToken = $this->helper->getAccessToken($callbackUrl);
            session(['token' => $accessToken]);
            if (!empty($accessToken)) {
//                $expires = $accessToken->getExpiresAt();
//                $expires = $expires->format('H:i:s');
////                $expires = $expires->format('Y-m-d H:i:s');
//                session(['expires'=>$expires]);
//                $current = date('Y-m-d H:i:s');
//                //$remain = new \DateTime($rs)->diff($current)->format("%d");
//                $date1 = new DateTime($rs);
//                $date2 = new DateTime($current);
//                dd($date1,$date2);
                $title = "Trang chủ";
                $params = ['fields' => 'name,picture,gender,id,birthday'];
                $response = $this->zalo->get(ZaloEndPoint::API_GRAPH_ME, $accessToken, $params);
                $profile = $response->getDecodedBody();
                session(['profile' => $profile]);
                return view('social.dashboard', compact('profile','title'));
            }
        }
    }
    public function friendList()
    {
        $accessToken=session('token');
        if(empty($accessToken))
        {
            return redirect('/');
        }
        $params = ['offset' => 0, 'fields' => "id,name,gender,picture"];
        $response = $this->zalo->get(ZaloEndpoint::API_GRAPH_FRIENDS, $accessToken, $params);
        $result = $response->getDecodedBody();
        $profile = session('profile');
        $total = $result['summary']['total_count'];
        $friends = $result['data'];
        session(['friends'=>$friends]);
        $title = "Gửi tin nhắn";
        return view('social.components.friend-list',compact('total','friends','profile','title'));
    }
    public function inviteList()
    {
        $accessToken=session('token');
         if(empty($accessToken))
        {
            return redirect('/');
        }
        $params = ['offset' => 0, 'fields' => "id,name,gender,picture"];
        $response = $this->zalo->get(ZaloEndpoint::API_GRAPH_INVITABLE_FRIENDS, $accessToken, $params);
        $result = $response->getDecodedBody();
        $profile = session('profile');
        $total = $result['summary']['total_count'];
        $friends = $result['data'];
        session(['invite_friends'=>$friends]);
        $title = "Gửi lời mời";
        return view('social.components.invite-list',compact('total','friends','profile','title'));
    }
    public function send(Request $request,$sendIds){
        $accessToken = session('token');
        if(empty($accessToken))
        {
       return response()->json(['success'=>false,'message'=>'invalid token']);
        }
        $idArr = explode(',',$sendIds);
        $result=array();
        foreach($idArr as $id) {
            $params = ['message' => $request->message, 'to' => $id, 'link' => $request->link];
            $response = $this->zalo->post(ZaloEndpoint::API_GRAPH_MESSAGE, $accessToken, $params);
            $rs = $response->getDecodedBody(); // result
            array_push($result,$rs['to']);
        }

        return response()->json(['success'=>true,'sendIds'=>$sendIds,'message'=>$request->message,'link'=>$request->link,'result'=>$result]);
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

                if ( stripos( Str::slug($fr['name']),  Str::slug($keyword)) == true|| stripos(Str::slug($fr['name']),  Str::slug($keyword)) ===0) {
                    array_push($friends, $fr);
                }
            }
        }
        $html = view('social.partials.friends')->with(compact('friends'))->render();
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
                if (stripos(Str::slug($fr['name']), Str::slug($keyword)) == true||stripos(Str::slug($fr['name']), Str::slug($keyword)) ===0) {
                    array_push($friends, $fr);
                }
            }
        }
        $html = view('social.partials.invite')->with(compact('friends'))->render();
        return response()->json(['success' => true, 'html' => $html]);
    }
    public function profile()
    {
        $profile = session('profile');
        $title = "Thông tin";
        return view('social.components.profile',compact('profile','title'));
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
        $title = "Gửi tin nhắn";
        return view('social.components.send-message',compact('receives','profile','sendIds','message','link','title'));
    }
    public function sendPreview(Request $request)
    {
        $profile = session('profile');
        $message = $request->message;
        $link = $request->link;
        $html = view('social.partials.send-preview')->with(compact('message','link','profile'))->render();
        return response()->json((['success'=>true,'html'=>$html]));
    }
    public function invitePreview(Request $request)
    {
        $profile = session('profile');
        $message = $request->message;
        $html = view('social.partials.invite-preview')->with(compact('message','profile'))->render();
        return response()->json((['success'=>true,'html'=>$html]));
    }
    public function statusPreview(Request $request)
    {
        $profile = session('profile');
        $message = $request->message;
        $link = $request->link;
        $html = view('social.partials.status-preview')->with(compact('message','link','profile'))->render();
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
        $title = "Gửi lời mời";
        return view('social.components.send-invite',compact('receives','profile','sendIds','message','title'));
    }
    public function invite(Request $request,$sendIds){
        $accessToken = session('token');
          if(empty($accessToken))
        {
       return response()->json(['success'=>false,'message'=>'invalid token']);
        }
        $params = ['message' => $request->message, 'to' => $sendIds];
        $response = $this->zalo->post(ZaloEndpoint::API_GRAPH_APP_REQUESTS, $accessToken, $params);
        $result = $response->getDecodedBody(); 
        return response()->json(['success'=>true,'complete'=>true,'result'=>$result]);
    }
    public function makeStatus(){
         $accessToken=session('token');
        if(empty($accessToken))
        {
            return redirect('/');
        }
        $profile = session('profile');
        $message="";
        $link="";
        $title = "Tạo bài viết";
        return view('social.components.post-status',compact('profile','message','link','title'));
    }
    public function postStatus(Request $request)
    {
        $accessToken = session('token');
         if(empty($accessToken))
        {
       return response()->json(['message'=>'invalid token']);
        }
        $params = ['message' => $request->message, 'link' => $request->link];
        $response = $this->zalo->post(ZaloEndpoint::API_GRAPH_POST_FEED, $accessToken, $params);
        $result = $response->getDecodedBody();
        if(!empty($result['id']))
        {
        return response()->json(['message'=>'Success']);
        }
        else{
              return response()->json(['message'=>$response['message']]);
        }
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
        $expires="asd";
        return Response()->json(['success'=>true,'expires'=>$expires]);
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
            return Response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }
}
