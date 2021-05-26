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

    public function followerChat($id)
    {
        $accessToken = session('oa_token');
       $data = json_encode([
           'offset'=>0,
           'count'=>10,
       ]);
           $client = new GuzzleHttp\Client();
            $res = $client->get('https://openapi.zalo.me/v2.0/oa/listrecentchat',
    ['query'=>[
        'data'=>$data,
        'access_token'=>$accessToken
            ]]);
             $result = json_decode($res->getBody());
             $recentMessages = $result->data;
    
             $data = json_encode([
                 'offset'=>0,
                 'user_id'=>(int)$id,
                 'count'=>10,
             ]);
               $res = $client->get('https://openapi.zalo.me/v2.0/oa/conversation',
            ['query'=>[
                'data'=>$data,
                'access_token'=>$accessToken
            ]]);
              $result = json_decode($res->getBody());
              $userMsgs = $result->data;
              $user = null;
              $userMessages = array();
              foreach($userMsgs as $message)
              {
                  $message->time = $this->getTime2($message->time);
                   array_unshift($userMessages,$message);
              }
              foreach($recentMessages as $message)
              {
                    $data = json_encode([
                        'user_id'=>$message->from_id,
                    ]);
                     $res = $client->get('https://openapi.zalo.me/v2.0/oa/getprofile',
                    ['query'=>[
                    'data'=>$data,
                    'access_token'=>$accessToken
                    ]]);
                       $result = json_decode($res->getBody());
                       if($result->message=="Success")
                       {
                           if($result->data->user_id == $id)
                           {
                               $user = $result->data;
                           }
                            $message->user = $result->data;
                       }
                       else{
                             $data = json_encode([
                        'user_id'=>$message->to_id,
                    ]);
                     $res = $client->get('https://openapi.zalo.me/v2.0/oa/getprofile',
                    ['query'=>[
                    'data'=>$data,
                    'access_token'=>$accessToken
                    ]]);
                       $result = json_decode($res->getBody());
                        if($result->data->user_id == $id)
                           {
                               $user = $result->data;
                           }
                       $message->user = $result->data;
                       }

                  $message->time = $this->getTime($message->time);
              }
         $oa_info = session('oa_info');
        $title = 'Gửi tin nhắn';
        return view('oa.components.followers-chat',compact('title','oa_info','recentMessages','userMessages','user'));
    }
    public function followerSendMessage(Request $request)
    {
        
        $user_id = $request->user_id;
        $message= $request->message;
        dd($user_id,$message);
          $accessToken = session('oa_token');
       $data = json_encode([
          'recipient'=>[
              'user_id'=>$user_id,
          ],
          'message'=>[
              'text'=>$message,
          ],
       ]);
           $client = new GuzzleHttp\Client();
         $result = $client->request('POST','https://openapi.zalo.me/v2.0/oa/message',[
                 'query'=>[
                     'access_token'=>$accessToken,
                 ],
                'body'=>$data,
         ]);
                  $response = json_decode($result->getBody());
                  return reponse()->json($response);

    }
    public function getTime($time)
    {
         $time =(int)substr((string)$time,0,10);
         $date = $start = strtotime(date("Y-m-d H:i:s"));
         if($date - $time < 86400)
         {
             return date("H:i",$time);
         }
         else{
             return date("d/m",$time);
         }
    }
        public function getTime2($time)
    {
         $time =(int)substr((string)$time,0,10);
  
             return date("H:i, d/m/Y",$time);
         
    }
    public function articleList(Request $request)
    {
        $client = new GuzzleHttp\Client();
        $accessToken = session('oa_token');
        $res = $client->get('https://openapi.zalo.me/v2.0/article/getslice',
    ['query'=>[
        'offset'=>0,
        'type'=>'normal',
        'limit'=>10,
        'access_token'=>$accessToken
            ]]);
       $result = json_decode($res->getBody());
       $data = $result->data;
       $total = $data->total;
        $articles = $data->medias;
       for($i = 1;$i<= ceil(($total-10)/10);$i++)
       {
               $res = $client->get('https://openapi.zalo.me/v2.0/article/getslice',
        ['query'=>[
        'offset'=>$i*10,
        'type'=>'normal',
        'limit'=>10,
        'access_token'=>$accessToken
            ]]);

              $result = json_decode($res->getBody());
             $data = $result->data;
             $arr = $data->medias;
             foreach($arr as $index=>$item)
             {
                array_push($articles,$item);
             }
            
       }
       session(['total_article'=>$total]);
        //  $total_page = (ceil($total / $limit));

      
        $oa_info = session('oa_info');
        $title="Bài viết";
        session(['articles'=>$articles]);
        // $paginate = $this->paginateTrait('/oa/article',$current_page,$total_page);

       return view('oa.components.articles',compact('articles','oa_info','title','total'));
    }
        public function videoList()
    {
        $client = new GuzzleHttp\Client();
        $accessToken = session('oa_token');
        $res = $client->get('https://openapi.zalo.me/v2.0/article/getslice',
        ['query'=>[
        'offset'=>0,
        'type'=>'video',
        'limit'=>10,
        'access_token'=>$accessToken
            ]]);
       $result = json_decode($res->getBody());
       $data = $result->data;
       $total = $data->total;
       $videos = $data->medias;
        for($i = 1;$i<= ceil(($total-10)/10);$i++)
       {
               $res = $client->get('https://openapi.zalo.me/v2.0/article/getslice',
        ['query'=>[
        'offset'=>$i*10,
        'type'=>'video',
        'limit'=>10,
        'access_token'=>$accessToken
            ]]);

              $result = json_decode($res->getBody());
             $data = $result->data;
             $arr = $data->medias;
             foreach($arr as $index=>$item)
             {
                array_push($videos,$item);
             }
            
       }
       session(['total_video'=>$total]);
        $oa_info = session('oa_info');
        $title="Bài viết video";
        session(['videos'=>$videos]);
       return view('oa.components.videos',compact('videos','oa_info','title','total'));
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
      public function videoSearch($keyword)
    {
         $arr = session('videos');
        $videos = array();
        if($keyword=="*")
        {
            $videos=$arr;
        }
        else {
            foreach ($arr as $item) {
                if (stripos(Str::slug($item->title), Str::slug($keyword)) == true||stripos(Str::slug($item->title), Str::slug($keyword)) ===0) {
                    array_push($videos, $item);
                }
            }
        }
        $html = view('oa.partials.videos')->with(compact('videos'))->render();
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
     public function videoSearchDate(Request $request)
    {
         $arr = session('videos');
        $start = strtotime($request->st);
        $end = strtotime($request->en);
        $videos = array();
            foreach ($arr as $item) {
                $date =(int)substr((string)$item->create_date,0,10);
                if ($date>=$start && $date<=$end) {
                    array_push($videos, $item);
                }
            }
        $html = view('oa.partials.videos')->with(compact('videos'))->render();
        return response()->json(['success' => true, 'html' => $html]);
    }
    public function articleResetDate()
    {
       $articles = session('articles');
         $html = view('oa.partials.articles')->with(compact('articles'))->render();
        return response()->json(['success' => true, 'html' => $html ]);
    }
       public function videoResetDate()
    {
       $videos = session('videos');
         $html = view('oa.partials.videos')->with(compact('videos'))->render();
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
             $result = $client->request('POST','https://openapi.zalo.me/v2.0/article/remove',[
                 'query'=>[
                     'access_token'=>$accessToken
                 ],
                'body'=>$data
         ]);
         $response = json_decode($result->getBody());
         if($response->message=="Success")
         {
              $articles = session('articles');
             $total = session('total_article');
             foreach($articles as $index=>$article)
             {
                 if($article->id == $id)
                 {
                     array_splice($articles,$index,1);
                     break;
                 }
             }
             $total -=1;
             session(['articles'=>$articles]);
             session(['total_article'=>$total]);
             return response()->json(['success'=>true,'total'=>$total]);
         }
         else{
             return response()->json(['success'=>false]);
         }
    }
       public function deleteVideo($id)
    {
        $accessToken = session('oa_token');
           $client = new \GuzzleHttp\Client();
           $data = json_encode([
               'id'=>$id
           ]);
             $result = $client->request('POST','https://openapi.zalo.me/v2.0/article/remove',[
                 'query'=>[
                     'access_token'=>$accessToken
                 ],
                'body'=>$data
         ]);
         $response = json_decode($result->getBody());
         if($response->message=="Success")
         {
             $videos = session('videos');
             $total = session('total_video');
             foreach($videos as $index=>$video)
             {
                 if($video->id == $id)
                 {
                     array_splice($videos,$index,1);
                     break;
                 }
             }
             $total -=1;
             session(['total_video'=>$total]);
             session(['videos'=>$videos]);

             return response()->json(['success'=>true,'total'=>$total]);
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
         $articles = session('articles');
        if(empty($videos))
        {
        $res = $client->get('https://openapi.zalo.me/v2.0/article/getslice',
        ['query'=>[
        'offset'=>0,
        'type'=>'normal',
        'limit'=>10,
        'access_token'=>$accessToken
            ]]);
       $result = json_decode($res->getBody());
       $data = $result->data;
       $total = $data->total;
       $articles = $data->medias;
        for($i = 1;$i<= ceil(($total-10)/10);$i++)
       {
               $res = $client->get('https://openapi.zalo.me/v2.0/article/getslice',
        ['query'=>[
        'offset'=>$i*10,
        'type'=>'normal',
        'limit'=>10,
        'access_token'=>$accessToken
            ]]);
              $result = json_decode($res->getBody());
             $data = $result->data;
             $arr = $data->medias;
             foreach($arr as $index=>$item)
             {
                array_push($articles,$item);
             }
       };
    }
    
     if($response->data->cover->cover_type=="video")
         {
             foreach($articles as $item)
             {
                 if($item->id == $id)
                 {
                     $response->data->cover->photo_url = $item->thumb;
                     break;
                 }
             }
         }
         $videos = $this->getListVideos();
        // dd($response,$articles);
         if($response->message=="Success")
         {
            $article  = $response->data;
            return view('oa.components.edit-article',compact('oa_info','title','article','videos'));
         }
    }
    public function getListVideos()
    {
         $accessToken = session('oa_token');
           $client = new \GuzzleHttp\Client();
           $videos = session('videos');
           if(empty($videos))
        {
         $client = new GuzzleHttp\Client();
        $accessToken = session('oa_token');
        $res = $client->get('https://openapi.zalo.me/v2.0/article/getslice',
        ['query'=>[
        'offset'=>0,
        'type'=>'video',
        'limit'=>10,
        'access_token'=>$accessToken
            ]]);
       $result = json_decode($res->getBody());
       $data = $result->data;
       $total = $data->total;
       $videos = $data->medias;
        for($i = 1;$i<= ceil(($total-10)/10);$i++)
       {
               $res = $client->get('https://openapi.zalo.me/v2.0/article/getslice',
        ['query'=>[
        'offset'=>$i*10,
        'type'=>'video',
        'limit'=>10,
        'access_token'=>$accessToken
            ]]);

              $result = json_decode($res->getBody());
             $data = $result->data;
             $arr = $data->medias;
             foreach($arr as $index=>$item)
             {
                array_push($videos,$item);
             }
       };
    }
    foreach($videos as $video)
    {
         $res = $client->get('https://openapi.zalo.me/v2.0/article/getdetail',
        ['query'=>[
        'id'=>$video->id,
        'access_token'=>$accessToken
            ]
            ]);
            
              $result = json_decode($res->getBody());
             $data = $result->data;
             $video->video_id = $data->video_id;
    }
        return $videos;
    }
    public function editVideo($id)
    {
         $accessToken = session('oa_token');
           $client = new \GuzzleHttp\Client();
             $result = $client->request('GET','https://openapi.zalo.me/v2.0/article/getdetail',[
                'query'=>[
                    'access_token'=>$accessToken,
                    'id'=>$id,
                ]
         ]);
         $videos = $this->getListVideos();
         $response = json_decode($result->getBody());
         $oa_info = session('oa_info');
         $title = "Chỉnh sửa video";
         if($response->message=="Success")
         {
            $video  = $response->data;
            return view('oa.components.edit-video',compact('oa_info','title','videos','video'));
         }
    }
    public function updateArticle(Request $request)
    {
             $accessToken = session('oa_token');
           $client = new \GuzzleHttp\Client();
           $data = json_encode([
               "cover"=> $request->cover,
            "author"=> $request->author,
            "description"=> $request->description,
            "id"=>$request->id,
            "type"=>"normal",
            "title"=>$request->title,
            "comment"=>$request->comment,
            "body"=> [
                [
                    "type"=> "text",
                    "content"=> $request->content,
                ]
            ],
            "status"=> $request->status,
            ]);
             $result = $client->request('POST','https://openapi.zalo.me/v2.0/article/update',[
                 'query'=>[
                     'access_token'=>$accessToken,
                 ],
                'body'=>$data
         ]);
         $response = json_decode($result->getBody());
            return response()->json($response);
    }
     public function updateVideo(Request $request,$id)
    {
         $accessToken = session('oa_token');
           $client = new \GuzzleHttp\Client();
             $avatar = null;
           if(trim($request->avatar)!="")
           {
               $avatar = ['avatar'=>$request->avatar];
           }
           $data = json_encode([
            "title"=>$request->title,
            "description"=> $request->description,
            "comment"=> $request->comment,
            'video_id'=>$request->video_id,
            "type"=>"video",
            'id'=>$id,  
            'status'=>$request->status,
            $avatar,
            ]);
             $result = $client->request('POST','https://openapi.zalo.me/v2.0/article/update',[
                 'query'=>[
                     'access_token'=>$accessToken,
                 ],
                'body'=>$data
         ]);
         $response = json_decode($result->getBody());
        return response()->json($response);
    }

    public function createArticle()
    {
        $oa_info = session('oa_info');
        $title="Tạo bài viết mới";
        $videos = session('videos');
        $videos = $this->getListVideos();
        return view('oa.components.create-article2',compact('oa_info','title','videos'));
    }
        public function createVideo()
    {
        $oa_info = session('oa_info');
        $title="Tạo bài video mới";
         $videos = $this->getListVideos();
        return view('oa.components.create-video',compact('oa_info','title','videos'));
    }
    public function storeArticle(Request $request)
    {
         $accessToken = session('oa_token');
           $client = new \GuzzleHttp\Client();
           $data = json_encode([
               "cover"=> $request->cover,
            "author"=> $request->author,
            "description"=> $request->description,
            "comment"=> "show",
            "type"=>"normal",
            "title"=>$request->title,
            'comment'=>$request->comment,
            "body"=> [
                [
                    "type"=> "text",
                    "content"=> $request->content,
                ]
            ],
            "status"=> $request->status,
            ]);
             $result = $client->request('POST','https://openapi.zalo.me/v2.0/article/create',[
                 'query'=>[
                     'access_token'=>$accessToken,
                 ],
                'body'=>$data
         ]);
         $response = json_decode($result->getBody());
        return response()->json($response);
    }
     public function storeVideo(Request $request)
    {
         $accessToken = session('oa_token');
           $client = new \GuzzleHttp\Client();
           $avatar = null;
           if(trim($request->avatar)!="")
           {
               $avatar = ['avatar'=>$request->avatar];
           }
           $data = json_encode([
            "title"=>$request->title,
            "description"=> $request->description,
            "comment"=> $request->comment,
            'video_id'=>$request->video_id,
            "type"=>"video",
            'status'=>$request->status,
            $avatar,
            ]);
             $result = $client->request('POST','https://openapi.zalo.me/v2.0/article/create',[
                 'query'=>[
                     'access_token'=>$accessToken,
                 ],
                'body'=>$data
         ]);
         $response = json_decode($result->getBody());
        return response()->json($response);
    }
    public function Broadcast(Request $request)
    {
       
         $client = new GuzzleHttp\Client();
        $accessToken = session('oa_token');
        $res = $client->get('https://openapi.zalo.me/v2.0/article/getslice',[
            'query'=>[
                'offset'=>0,
                'limit'=>10,
                'type'=>'normal',
                'access_token'=>$accessToken
            ]
        ]);
       $result = json_decode($res->getBody());
       $data = $result->data;
       $total_article = $data->total;
       $broadcasts = $data->medias;
       foreach($broadcasts as $idex=>$item)
       {
           $item->selected=false;
       }
        for($i = 1;$i<= ceil(($total_article-10)/10);$i++)
       {
               $res = $client->get('https://openapi.zalo.me/v2.0/article/getslice',
        ['query'=>[
        'offset'=>$i*10,
        'type'=>'normal',
        'limit'=>10,
        'access_token'=>$accessToken
            ]]);

              $result = json_decode($res->getBody());
             $data = $result->data;
             $arr = $data->medias;
             foreach($arr as $index=>$item)
             {
                 $item->selected=false;
                array_push($broadcasts,$item);
             }
       }
       
       $res = $client->get('https://openapi.zalo.me/v2.0/article/getslice',[
            'query'=>[
                'offset'=>0,
                'limit'=>10,
                'type'=>'video',
                'access_token'=>$accessToken
            ]
        ]);
       $result = json_decode($res->getBody());
       $data = $result->data;
       $total_video = $data->total;
       $videos = $data->medias;
       foreach($videos as $idex=>$item)
       {
           $item->selected=false;
       }
        for($i = 1;$i<= ceil(($total_video-10)/10);$i++)
       {
               $res = $client->get('https://openapi.zalo.me/v2.0/article/getslice',
        ['query'=>[
        'offset'=>$i*10,
        'type'=>'video',
        'limit'=>10,
        'access_token'=>$accessToken
            ]]);

              $result = json_decode($res->getBody());
             $data = $result->data;
             $arr = $data->medias;
             foreach($arr as $index=>$item)
             {
                 $item->selected=false;
                array_push($videos,$item);
             }
       }
        foreach($videos as $video)
        {
            array_push($broadcasts,$video);
        }
        $oa_info = session('oa_info');
        $title="Gửi broadcast";
        session(['broadcasts'=>$broadcasts]);
       return view('oa.components.broadcast',compact('broadcasts','oa_info','title','total_article','total_video'));
    }
    public function selectBroadcast($id)
    {
        $broadcasts=session('broadcasts');
        foreach($broadcasts as $broadcast=>$item)
        {
            if($item->id==$id)
            {
                $item->selected=true;
                break;
            }
        }
        session(['broadcasts'=>$broadcasts]);
      $article_html = view('oa.partials.broadcast')->with(compact('broadcasts'))->render();
        $video_html = view('oa.partials.video-broadcast')->with(compact('broadcasts'))->render();
        return response()->json(['success' => true, 'article_html' => $article_html,'video_html'=>$video_html]);
    }
    public function unselectBroadcast($id)
    {
        $broadcasts=session('broadcasts');
        foreach($broadcasts as $broadcast=>$item)
        {
            if($item->id==$id)
            {
                $item->selected=false;
                break;
            }
        }
        session(['broadcasts'=>$broadcasts]);
      $article_html = view('oa.partials.broadcast')->with(compact('broadcasts'))->render();
        $video_html = view('oa.partials.video-broadcast')->with(compact('broadcasts'))->render();
        return response()->json(['success' => true, 'article_html' => $article_html,'video_html'=>$video_html]);
    }
    public function searchBroadcast($keyword)
    {
        $arr = session('broadcasts');
        $broadcasts = array();
        if($keyword=="*")
        {
            $broadcasts=$arr;
        }
        else {
            foreach ($arr as $item) {
                if (stripos(Str::slug($item->title), Str::slug($keyword)) == true||stripos(Str::slug($item->title), Str::slug($keyword)) ===0) {
                    array_push($broadcasts, $item);
                }
            }
        }
        $article_html = view('oa.partials.broadcast')->with(compact('broadcasts'))->render();
        $video_html = view('oa.partials.video-broadcast')->with(compact('broadcasts'))->render();
        return response()->json(['success' => true, 'article_html' => $article_html,'video_html'=>$video_html]);
    }

       public function broadcastSearchDate(Request $request)
    {
         $arr = session('broadcasts');
        $start = strtotime($request->st);
        $end = strtotime($request->en);
        $broadcasts = array();
            foreach ($arr as $item) {
                $date =(int)substr((string)$item->create_date,0,10);
                if ($date>=$start && $date<=$end) {
                    array_push($broadcasts, $item);
                }
            }
    $article_html = view('oa.partials.broadcast')->with(compact('broadcasts'))->render();
        $video_html = view('oa.partials.video-broadcast')->with(compact('broadcasts'))->render();
        return response()->json(['success' => true, 'article_html' => $article_html,'video_html'=>$video_html]);
    }
    public function broadcastResetDate()
    {
       $broadcasts = session('broadcasts');
       $article_html = view('oa.partials.broadcast')->with(compact('broadcasts'))->render();
        $video_html = view('oa.partials.video-broadcast')->with(compact('broadcasts'))->render();
        return response()->json(['success' => true, 'article_html' => $article_html,'video_html'=>$video_html]);
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
           return response()->json($result);


}

}

