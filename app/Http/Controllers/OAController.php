<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Zalo\Zalo;
use GuzzleHttp;
use Zalo\ZaloEndPoint;
use Illuminate\Support\Str;
use App\Traits\PaginateTrait;
class OAController extends Controller
{
    use paginateTrait;
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
    public function followersList(Request $request)
    {
        $current_page = 1;
        if($request->has('page'))
        {
            $current_page = $request->query('page');
        }
        $limit = 20;
        $offset = ($current_page-1)*$limit;
        $accessToken = session('oa_token');
        $data = ['data' => json_encode(array(
            'offset' => $offset,
            'count' => $limit
        ))];

        $response = $this->zalo->get(ZaloEndPoint::API_OA_GET_LIST_FOLLOWER, $accessToken, $data);
        $result = $response->getDecodedBody();
        $follower_ids = $result['data']['followers'];
        $total = $result['data']['total'];
           $total_page = (ceil($total / $limit));
        $followers = array();
        foreach($follower_ids as $follower) {
            $data = ['data' => json_encode(array(
                'user_id' => $follower['user_id']
            ))];
            $response = $this->zalo->get(ZaloEndpoint::API_OA_GET_USER_PROFILE, $accessToken, $data);
            $result = $response->getDecodedBody(); // result
            array_push($followers,$result['data']);
        }
        session(['followers'=>$followers]);
        $oa_info = session('oa_info');
        $title="Người theo dõi";
        $paginate = $this->paginateTrait("/oa/list",$current_page,$total_page);

        return view('oa.components.followers',compact('followers','oa_info','title','total','paginate'));
    }
    public function articleList(Request $request)
    {
        $client = new GuzzleHttp\Client();
         $current_page = 1;
        if($request->has('page'))
        {
            $current_page = $request->query('page');
        }
        $limit = 10;
        $offset = ($current_page-1)*$limit;
        $accessToken = session('oa_token');
        $res = $client->get('https://openapi.zalo.me/v2.0/article/getslice',
    ['query'=>[
        'offset'=>$offset,
        'type'=>'normal',
        'limit'=>$limit,
        'access_token'=>$accessToken
            ]]);
       $result = json_decode($res->getBody());
       $data = $result->data;
       $total = $data->total;
         $total_page = (ceil($total / $limit));

       $articles = $data->medias;
        $oa_info = session('oa_info');
        $title="Bài viết";
        session(['articles'=>$articles]);
        $paginate = $this->paginateTrait('/oa/article',$current_page,$total_page);

       return view('oa.components.articles',compact('articles','oa_info','title','total','paginate'));
    }
        public function videoList(Request $request)
    {
        $client = new GuzzleHttp\Client();
         $current_page = 1;
        if($request->has('page'))
        {
            $current_page = $request->query('page');
        }
        $limit = 10;
        $offset = ($current_page-1)*$limit;
        $accessToken = session('oa_token');
        $res = $client->get('https://openapi.zalo.me/v2.0/article/getslice',
    ['query'=>[
        'offset'=>$offset,
        'type'=>'video',
        'limit'=>$limit,
        'access_token'=>$accessToken
            ]]);
       $result = json_decode($res->getBody());
       $data = $result->data;
       $total = $data->total;
         $total_page = (ceil($total / $limit));

       $videos = $data->medias;
        $oa_info = session('oa_info');
        $title="Bài viết";
        session(['videos'=>$videos]);
        $paginate = $this->paginateTrait('/oa/video',$current_page,$total_page);

       return view('oa.components.videos',compact('videos','oa_info','title','total','paginate'));
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
        $accessToken = session('oa_token');
              $client = new \GuzzleHttp\Client();
        $response = $client->get('https://openapi.zalo.me/v2.0/article/getslice',['query'=>[
               'offset'=>0,
               'type'=>'video',
               'access_token'=>$accessToken
           ]]);
           $rs= json_decode($response->getBody());
            // dd($rs);
           $videos = $rs->data->medias;

        $title="Tạo bài viết văn bản";
        return view('oa.components.create-article',compact('oa_info','title','videos'));
    }
    public function createVideoArticle()
    {
        $oa_info = session('oa_info');

        $title="Tạo bài viết video";
        return view('oa.components.create-video-article',compact('oa_info','title'));
    }
    public function textArticle()
    {
          $articles = session('articles');
            $html = view('oa.partials.articles')->with(compact('articles'))->render();
              return response()->json(['success' => true, 'html' => $html]);
     
    }
    public function videoArticle()
    {
        $articles = session('videos');
        if(empty($articles))
        {
                $accessToken = session('oa_token');
                 $client = new \GuzzleHttp\Client();  
              $res = $client->get('https://openapi.zalo.me/v2.0/article/getslice',
             ['query'=>[
                'offset'=>0,
            'type'=>'video',
            'limit'=>10,
            'access_token'=>$accessToken
            ]]);
            $result = json_decode($res->getBody());
                   $data = $result->data;
                    $articles = $data->medias;
                    session(['videos'=>$articles]);
        }
         $html = view('oa.partials.articles')->with(compact('articles'))->render();
        return response()->json(['success' => true, 'html' => $html]);
     
    }
    public function articleSearch($keyword)
    {
         $arr = session('articles');
        $articles = array();
        if($keyword=="*")
        {
            $articles=$arr;
        }
        else {
            foreach ($arr as $item) {
                if (stripos(Str::slug($item->title), Str::slug($keyword)) == true||stripos(Str::slug($item->title), Str::slug($keyword)) ===0) {
                    array_push($articles, $item);
                }
            }
        }
        $html = view('oa.partials.articles')->with(compact('articles'))->render();
        return response()->json(['success' => true, 'html' => $html]);
    }
    public function articleSearchDate(Request $request)
    {
         $arr = session('articles');
        $start = strtotime($request->st);
        $end = strtotime($request->en);
        $articles = array();
            foreach ($arr as $item) {
                $date =(int)substr((string)$item->create_date,0,10);
                if ($date>=$start && $date<=$end) {
                    array_push($articles, $item);
                }
            }
        $html = view('oa.partials.articles')->with(compact('articles'))->render();
        return response()->json(['success' => true, 'html' => $html]);
    }
    public function articleResetDate()
    {
       $articles = session('articles');
         $html = view('oa.partials.articles')->with(compact('articles'))->render();
        return response()->json(['success' => true, 'html' => $html ]);
    }
    public function followerSearch($keyword)
    {
         $frs = session('followers');
        $followers = array();
        if($keyword=="*")
        {
            $followers=$frs;
        }
        else {
            foreach ($frs as $fr) {
                if (stripos(Str::slug($fr['display_name']), Str::slug($keyword)) == true||stripos(Str::slug($fr['display_name']), Str::slug($keyword)) ===0) {
                    array_push($followers, $fr);
                }
            }
        }
        $html = view('oa.partials.followers')->with(compact('followers'))->render();
        return response()->json(['success' => true, 'html' => $html]);
    }
    public function deleteArticle($id)
    {
        $accessToken = session('oa_token');
           $client = new \GuzzleHttp\Client();
           $data = json_encode([
               'id'=>$id
           ]);
             $result = $client->request('POST','https://openapi.zalo.me/v2.0/article/remove'.$accessToken,[
                 'query'=>[
                     'access_token'=>$accessToken
                 ],
                'body'=>$data
         ]);
         $response = json_decode($result->getBody());
         if($response->message=="Success")
         {
             return response()->json(['success'=>true]);
         }
         else{
             return response()->json(['success'=>false]);
         }
    }
    public function editArticle($id)
    {
         $accessToken = session('oa_token');
           $client = new \GuzzleHttp\Client();
           $data = json_encode([
               'id'=>$id
           ]);
             $result = $client->request('GET','https://openapi.zalo.me/v2.0/article/getdetail',[
                'query'=>[
                    'access_token'=>$accessToken,
                    'id'=>$id,
                ]
         ]);
         $response = json_decode($result->getBody());
         $oa_info = session('oa_info');
         $title = "Chỉnh sửa bài viết";
         if($response->message=="Success")
         {
            $article  = $response->data;
            return view('oa.components.edit-article',compact('oa_info','title','article'));
         }
    }
    public function updateArticle(Request $request)
    {
             $accessToken = session('oa_token');
           $client = new \GuzzleHttp\Client();
           $data = json_encode([
               "cover"=> [
            "photo_url"=> $request->photo_url,
            "cover_type"=> "photo",
            "status"=> "show"
            ],
            "author"=> $request->author,
            "description"=> $request->description,
            "comment"=> "show",
            "id"=>$request->id,
            "type"=>"normal",
            "title"=>$request->title,
            "body"=> [
                [
                    "type"=> "text",
                    "content"=> $request->content,
                ]
            ],
            "status"=> "show"
            ]);
             $result = $client->request('POST','https://openapi.zalo.me/v2.0/article/update',[
                 'query'=>[
                     'access_token'=>$accessToken,
                 ],
                'body'=>$data
         ]);
         $response = json_decode($result->getBody());
            return redirect('/oa/article');
    }
    public function createArticle()
    {
        $oa_info = session('oa_info');
        $title="Tạo bài viết mới";
        return view('oa.components.create-article2',compact('oa_info','title'));
    }
    public function storeArticle(Request $request)
    {
         $accessToken = session('oa_token');
           $client = new \GuzzleHttp\Client();
           $data = json_encode([
               "cover"=> [
            "photo_url"=> $request->photo_url,
            "cover_type"=> "photo",
            "status"=> "show"
            ],
            "author"=> $request->author,
            "description"=> $request->description,
            "comment"=> "show",
            "type"=>"normal",
            "title"=>$request->title,
            "body"=> [
                [
                    "type"=> "text",
                    "content"=> $request->content,
                ]
            ],
            "status"=> "show"
            ]);
             $result = $client->request('POST','https://openapi.zalo.me/v2.0/article/create',[
                 'query'=>[
                     'access_token'=>$accessToken,
                 ],
                'body'=>$data
         ]);
         $response = json_decode($result->getBody());
            return redirect('/oa/article');
    }
    public function Broadcast(Request $request)
    {
        $current_page = 1;
        if($request->has('page'))
        {
            $current_page = $request->query('page');
        }
        $limit = 10;
        $offset = ($current_page-1)*$limit;

         $client = new GuzzleHttp\Client();
        $accessToken = session('oa_token');
        $res = $client->get('https://openapi.zalo.me/v2.0/article/getslice',[
            'query'=>[
                'offset'=>$offset,
                'limit'=>$limit,
                'type'=>'normal',
                'access_token'=>$accessToken
            ]
        ]);
       $result = json_decode($res->getBody());
       $data = $result->data;
       $total = $data->total;
        $total_page = (ceil($total / $limit));
       $articles = $data->medias;
        $oa_info = session('oa_info');
        $title="Gửi broadcast";
        session(['broadcasts'=>$articles]);
        $paginate = $this->paginateTrait("/oa/broadcast",$current_page,$total_page);

       return view('oa.components.broadcast',compact('articles','oa_info','title','total','paginate'));
    }
    public function searchBroadcast($keyword)
    {
        $arr = session('broadcasts');
        $articles = array();
        if($keyword=="*")
        {
            $articles=$arr;
        }
        else {
            foreach ($arr as $item) {
                if (stripos(Str::slug($item->title), Str::slug($keyword)) == true||stripos(Str::slug($item->title), Str::slug($keyword)) ===0) {
                    array_push($articles, $item);
                }
            }
        }
        $html = view('oa.partials.broadcast')->with(compact('articles'))->render();
        return response()->json(['success' => true, 'html' => $html]);
    }

       public function broadcastSearchDate(Request $request)
    {
         $arr = session('broadcasts');
        $start = strtotime($request->st);
        $end = strtotime($request->en);
        $articles = array();
            foreach ($arr as $item) {
                $date =(int)substr((string)$item->create_date,0,10);
                if ($date>=$start && $date<=$end) {
                    array_push($articles, $item);
                }
            }
        $html = view('oa.partials.broadcast')->with(compact('articles'))->render();
        return response()->json(['success' => true, 'html' => $html]);
    }
    public function broadcastResetDate()
    {
       $articles = session('broadcasts');
        $html = view('oa.partials.broadcast')->with(compact('articles'))->render();
        return response()->json(['success' => true, 'html' => $html]);
    }

        public function viewBroadcast($id_str)
    {
        $id_arr = explode(",",$id_str);
        $broadcasts = session("broadcasts");
        $broadcast = array();
        foreach($broadcasts as $item)
        {
            if(in_array($item->id,$id_arr))
            {
                array_push($broadcast,$item);
            }
        }
           $oa_info = session('oa_info');
        $title="Gửi broadcast";
        return view('oa.components.view-broadcast',compact('broadcast','oa_info','title'));

    }
    public function sendBroadcast(Request $request)
    {
        $gender = $request->gender;

        $age = implode(',',$request->age);
        $platform = implode(',',$request->platform);
        $id_arr = [];

          foreach($request->id as $id)
            {
                array_push($id_arr,[
                    'media_type'=>'article',
                    'attachment_id'=>$id,
                ]);
            }

          $accessToken = 'AEma5D8bHXGgwoWNrY1F4o7cAnVSDpHNO_in2UbkAajamqyYtn5NIoMsDHYd85LdCP4p3yygK4nifKCmaor2DJocH4x3ArOuUwvCRTmxJMf2laewk0LEEmoELKAM0KmTDgj9Gi4CB0TNlZLXsWjK3o63HL2rEKOLA95qRwajPWWWucLXZLvc91l5Nrc53L4vBR0oLx5w4J0KpGTgcm0qFnkCEagp1mmTAwmLVxyv7Iy6XovF-40T2mNC3a_uL3iGHjm6MEv0CX5XyL1kspOg5tomB59rOix_Lp7LFK4S';
          $data=json_encode([
              'recipient'=>[
                  'target'=>[
                      'age'=>$age,
                      'gender'=>$gender,
                      'platform'=>$platform,
                  ]
                  ],
                  'message'=>[
                      'attachment'=>[
                          'type'=>'template',
                          'payload'=>[
                              'template_type'=>'media',
                              'elements'=>$id_arr,
                          ]
                      ]
                  ]
          ]);
          $client = new \GuzzleHttp\Client();
         $rs = $client->request('POST','https://openapi.zalo.me/v2.0/oa/message',['query'=>[
               'access_token'=>$accessToken
                 ],
                 'body'=>$data,
           ]);
           $result = json_decode($rs->getBody());
           dd($result);
             dd($request->age,$request->gender,$request->id,$request->platform);


}

}

