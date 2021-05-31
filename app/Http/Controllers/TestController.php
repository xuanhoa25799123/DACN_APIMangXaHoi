<?php

namespace App\Http\Controllers;

use Goutte\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use App\Traits\PaginateTrait;
use mysql_xdevapi\Exception;

class TestController extends Controller
{
    use paginateTrait;
    public function login()
    {
        return view('test.login');
    }
    public function dashboard()
    {
            $profile = array();
            $profile['id']="23151332135";
            $profile['name']="Abc";
            $profile['picture']['data']['url']='/storage/falco.jfif';
            $profile['gender']="Male";
            $profile['birthday']='10/12/2008';
            session(['profile'=>$profile]);
            $title="Trang chủ";
            return view('test.dashboard',compact('profile','title'));
    }
    public function friendList()
    {
        $result = array();
        $result['data']=array();
        $result['summary']['total_count']=2;
        $item1 = array();
        $item1['name']='Dũng Nt';
        $item1['gender']='Female';
        $item1['picture']['data']['url']='/storage/sora.jfif';
        $item1['id']='555';
        $item2 = array();
        $item2['name']='Đào Xuân Hoà';
        $item2['gender']='Male';
        $item2['picture']['data']['url']='/storage/reiner.png';
        $item2['id']='444';
        $item3 = array();
        $item3['name']='Bửu NC';
        $item3['gender']='Male';
        $item3['picture']['data']['url']='/storage/eren.png';
        $item3['id']='333';
        $item4 = array();
        $item4['name']='Danh Kun';
        $item4['gender']='Female';
        $item4['picture']['data']['url']='/storage/falco.jfif';
        $item4['id']='222';
        $item5 = array();
        $item5['name']='Minh Duck';
        $item5['gender']='Male';
        $item5['picture']['data']['url']='/storage/yota.jpg';
        $item5['id']='111';
        array_push($result['data'],$item1);
        array_push($result['data'],$item2);
        array_push($result['data'],$item3);
        array_push($result['data'],$item4);
        array_push($result['data'],$item5);
        $friends=$result['data'];

        $profile = session('profile');
        $total = $result['summary']['total_count'];
        $title="Gủi tin nhắn";
//        dd($friends);
        return view('test.components.friend-list',compact('total','friends','profile','title'));
    }
    public function inviteList()
    {
        $result = array();
        $result['data']=array();
        $result['summary']['total_count']=2;
        $item1 = array();
        $item1['name']='Dũng Nt';
        $item1['gender']='Male';
        $item1['picture']['data']['url']='/storage/sora.jfif';
        $item1['id']='123';
        $item2 = array();
        $item2['name']='Đào Xuân Hoà';
        $item2['gender']='Male';
        $item2['picture']['data']['url']='/storage/reiner.png';
        $item2['id']='321';
        array_push($result['data'],$item1);
        array_push($result['data'],$item2);
        $friends = $result['data'];
        session(['invite_friends'=>$friends]);
        $profile = session('profile');
        $total = $result['summary']['total_count'];
        $title = "Mời tham gia";
        return view('test.components.invite-list',compact('total','friends','profile','title'));
    }
    public function send(Request $request,$sendIds)
    {
        return response()->json(['success'=>'true','sendIds'=>$sendIds,'message'=>$request->message,'link'=>$request->link]);
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
        $html = view('test.partials.friends')->with(compact('friends'))->render();
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
        $html = view('test.partials.invite')->with(compact('friends'))->render();
        return response()->json(['success' => true, 'html' => $html]);
    }
    public function profile()
    {
        $profile = session('profile');
        return view('test.components.profile',compact('profile'));
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
        return view('test.components.send-message',compact('receives','profile','sendIds','message','link','title'));
    }
//    public function sendMessages(Request $request)
//    {
//        $receives = array();
//        $friends = session('friends');
//        $profile = session('profile');
//        $sendIds = "";
//        foreach($friends as $friend)
//        {
//            if(in_array($friend['id'],$request->selected))
//            {
//                $sendIds .= $friend['id'];
//                array_push($receives,$friend);
//            }
//        }
//        $sendIds=substr($sendIds,0,-1);
//        return view('test.components.send-message',compact('receives','profile','sendIds'));
//    }
    public function statusPreview(Request $request)
    {
        $profile = session('profile');
        $message = $request->message;
        $link = $request->link;
        $html = view('test.partials.status-preview')->with(compact('message','link','profile'))->render();
        return response()->json((['success'=>true,'html'=>$html]));
    }
    public function messagePreview(Request $request)
    {
        $profile = session('profile');
        $message = $request->message;
        $link = $request->link;
        $html = view('test.partials.send-preview')->with(compact('message','link','profile'))->render();
        return response()->json((['success'=>true,'html'=>$html]));
    }
    public function invitePreview(Request $request)
    {
        $profile = session('profile');
        $message = $request->message;
        $html = view('test.partials.invite-preview')->with(compact('message','profile'))->render();
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
        return view('test.components.send-invite',compact('receives','profile','sendIds','message','title'));
    }
    public function invite(Request $request,$sendIds){
        $result = array();
        $result['to']=array();
        array_push($result['to'],123);
//        array_push($result['to'],321);
        $sendArr = explode(',',$sendIds);
        if(count($sendArr)==count($result['to']))
        {
            return response()->json(['success'=>'true','complete'=>true,'count'=>count($result['to'])]);
        }
        else{
            $unsend = "";
            $count = 0;
            foreach($sendArr as $item)
            {
                if(!in_array($item,$result['to']))
                {
                    $count++;
                    if($unsend=="")
                    {
                        $unsend .= $item;
                    }
                    else{
                        $unsend .=','.$item;
                    }
                }
            }
            return response()->json(['success'=>'true','complete'=>false,'unsend'=>$unsend,'count'=>$count]);
        }

    }
    public function makeStatus()
    {
        $profile = session('profile');
        $message="";
        $link="";
        $title = "Tạo bài viết";
        return view('test.components.post-status',compact('profile','message','link','title'));
    }
    public function postStatus(Request $request)
    {
        $message = $request->message;
        $link = $request->link;
        return response()->json(['success'=>true,'message'=>$message,'link'=>$link]);
    }
    public function urlPreview()
    {
        $profile=session('profile');
        $title = "Gửi tin nhắn";
        return view('test.components.preview-url',compact('profile','title'));
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
                    if ($crawler->filterXpath('//meta[@property="og:title"]')->count()) {
                        $title2 = $crawler->filterXpath('//meta[@property="og:title"]')->attr('content');
                    }
                    if ($crawler->filterXpath('//meta[@property="og:image"]')->count()) {
                        $image = $crawler->filterXpath('//meta[@property="og:image"]')->attr('content');
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
                    $results['title2']=$title2;
                }
            }
            dd($results);
            if (count($results) > 0) {
                return response()->json(['success' => true, 'data' => $results]);
            }
            return response()->json(['success' => false, 'data' => $results]);
        }
        catch (\Exception $e) {
            return response()->json(['success' => false, 'data' => $e->getMessage()]);
        }
    }
    public function utcTime()
    {
        $time = time();
        dd(date("Y-m-d H:i:s", $time));
    }
    public function articleList()
    {
        $client = new \GuzzleHttp\Client();
//        $accessToken = session('oa_token');
        $res = $client->get('https://openapi.zalo.me/v2.0/article/getslice?offset=0&limit=5&type=normal&access_token=-jhyLUMxC2hutV1MuRuvBVFGyrRhgKD0-Sg2LvlL4bVdpwTLhkWEJl68n4oDht1Owh-aVuwbQcRXWyOUd-DSCep3uGZ2urqggFYMAFNsNL2ExlDEq-X1D9sCwJFlzdqsekorCUVNVmUQmxTvtyjt1vAnv2_XbquIh_F-EFF-PZYvtSeXvCHq5PdRn3J-uWmKuiM65l2g7Ig9oD45n-jc9hJExpVwso0qWlcA6uJ27cR2eR5ZW8zzUSY7pW22XWS5aOMc7UAt3o6efhmB-zmtSO3_dqtpx2DrZVISR2jN-KxYepSY');
        dd(json_decode($res->getBody()));

    }
    public function testDate()
    {
        $time = 1619749166;
        $time2 = 1617795697;
        dd(Date(date('Y-m-d H:i:s',$time)),Date(date('Y-m-d H:i:s',$time2)));
    }
    public function videoArticle()
    {
           $profile=session('profile');
        $title = "Article";
        return view('test.components.video-article',compact('profile','title'));
    }
    public function createVideo(Request $request)
    {
        try{
        // return response()->json(['success'=>true,'result'=>$request->video]);
        $accessToken = 'AEma5D8bHXGgwoWNrY1F4o7cAnVSDpHNO_in2UbkAajamqyYtn5NIoMsDHYd85LdCP4p3yygK4nifKCmaor2DJocH4x3ArOuUwvCRTmxJMf2laewk0LEEmoELKAM0KmTDgj9Gi4CB0TNlZLXsWjK3o63HL2rEKOLA95qRwajPWWWucLXZLvc91l5Nrc53L4vBR0oLx5w4J0KpGTgcm0qFnkCEagp1mmTAwmLVxyv7Iy6XovF-40T2mNC3a_uL3iGHjm6MEv0CX5XyL1kspOg5tomB59rOix_Lp7LFK4S';
         $url2 = 'https://openapi.zalo.me/v2.0/article/getslice?offset=0&limit=5&type=normal&access_token=-jhyLUMxC2hutV1MuRuvBVFGyrRhgKD0-Sg2LvlL4bVdpwTLhkWEJl68n4oDht1Owh-aVuwbQcRXWyOUd-DSCep3uGZ2urqggFYMAFNsNL2ExlDEq-X1D9sCwJFlzdqsekorCUVNVmUQmxTvtyjt1vAnv2_XbquIh_F-EFF-PZYvtSeXvCHq5PdRn3J-uWmKuiM65l2g7Ig9oD45n-jc9hJExpVwso0qWlcA6uJ27cR2eR5ZW8zzUSY7pW22XWS5aOMc7UAt3o6efhmB-zmtSO3_dqtpx2DrZVISR2jN-KxYepSY';
        $url ='https://openapi.zalo.me/v2.0/article/getslice?offset=0&limit=5&type=video&access_token=AEma5D8bHXGgwoWNrY1F4o7cAnVSDpHNO_in2UbkAajamqyYtn5NIoMsDHYd85LdCP4p3yygK4nifKCmaor2DJocH4x3ArOuUwvCRTmxJMf2laewk0LEEmoELKAM0KmTDgj9Gi4CB0TNlZLXsWjK3o63HL2rEKOLA95qRwajPWWWucLXZLvc91l5Nrc53L4vBR0oLx5w4J0KpGTgcm0qFnkCEagp1mmTAwmLVxyv7Iy6XovF-40T2mNC3a_uL3iGHjm6MEv0CX5XyL1kspOg5tomB59rOix_Lp7LFK4S';
        $url3 = 'https://openapi.zalo.me/v2.0/article/create?access_token=AEma5D8bHXGgwoWNrY1F4o7cAnVSDpHNO_in2UbkAajamqyYtn5NIoMsDHYd85LdCP4p3yygK4nifKCmaor2DJocH4x3ArOuUwvCRTmxJMf2laewk0LEEmoELKAM0KmTDgj9Gi4CB0TNlZLXsWjK3o63HL2rEKOLA95qRwajPWWWucLXZLvc91l5Nrc53L4vBR0oLx5w4J0KpGTgcm0qFnkCEagp1mmTAwmLVxyv7Iy6XovF-40T2mNC3a_uL3iGHjm6MEv0CX5XyL1kspOg5tomB59rOix_Lp7LFK4S';
        $url4='https://openapi.zalo.me/v2.0/article/upload_video/preparevideo?access_token=AEma5D8bHXGgwoWNrY1F4o7cAnVSDpHNO_in2UbkAajamqyYtn5NIoMsDHYd85LdCP4p3yygK4nifKCmaor2DJocH4x3ArOuUwvCRTmxJMf2laewk0LEEmoELKAM0KmTDgj9Gi4CB0TNlZLXsWjK3o63HL2rEKOLA95qRwajPWWWucLXZLvc91l5Nrc53L4vBR0oLx5w4J0KpGTgcm0qFnkCEagp1mmTAwmLVxyv7Iy6XovF-40T2mNC3a_uL3iGHjm6MEv0CX5XyL1kspOg5tomB59rOix_Lp7LFK4S';
        $client = new \GuzzleHttp\Client();

        // $data = fopen($video,'rb');
        // $size =filesize($video);
        // $contents=fread($data,$size);
        // fclose($data);
        // $encode = base64_encode($contents);

        $result = $client->request('POST','https://openapi.zalo.me/v2.0/article/upload_video/preparevideo',[
                'query'=>[
                    'access_token'=>$accessToken,
                ],
                'body'=>[
                    'file'=>$request->video
                ]
         ]);
         $rs = json_decode($result->getBody());
        // $data = json_encode([

        //             'description'=>"bai viet moi",
        //             'comment'=>'show',
        //             'avatar'=>'https://genk.mediacdn.vn/2019/12/15/photo-1-15764031803621965695036.jpg',
        //             'type'=>'video',
        //             'title'=>'bai viet moi',
        //             'video_id'=>'657c3ff306b6efe8b6a7',
        //             'status'=>'show',
        // ]);
        // $data = json_encode([
        //     'file'=>$request->file,
        // ]);
        // $video = $request->video;
        // $data =  fopen($video, 'rb');
        // $size=filesize ($image);
        // $contents= fread ($data, $size);
        // fclose ($data);
        //   return response()->json(['success'=>true,'result'=>$data]);
        // $fd = json_encode([
        //     'file'=>$data
        // ]);
        //    $result = $client->request('POST',$url4,['body'=>$fd]);
        //    $result = $client->get('https://openapi.zalo.me/v2.0/article/getslice',['query'=>[
        //        'offset'=>0,
        //        'limit'=>5,
        //        'type'=>'video',
        //        'access_token'=>$accessToken
        //    ]]);
        //    $rs = json_decode($result->getBody());
        //   $rs = $rs->data->medias;
        //    forEach($rs->data->medias as $item)
        //    {
        //         //   return response()->json(['success'=>true,'result'=>  $item->id]);
        //        $id = $item->id;
        //         $detail = $client->get('https://openapi.zalo.me/v2.0/article/getdetail',['query'=>[
        //             'id'=>$id,
        //             'access_token'=>$accessToken
        //         ]]);
        //         $abc = json_decode($detail->getBody());

        //         $video_id = $abc->data->video_id;
        //             return response()->json(['success'=>true,'result'=>  $abc]);
        //         $item->video_id = $video_id;
        //    }
        //  $result = $client->get($url2);

        return response()->json(['success'=>true,'result'=>$rs]);
        }catch(Exception $e)
        {
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }
    public function createArticle()
    {
          $title = "Tạo bài viết";
            $oa_info = session('oa_info');
           return view('test.components.create-article',compact('title','oa_info'));
    }
    public function editArticle()
    {
                $accessToken = 'AEma5D8bHXGgwoWNrY1F4o7cAnVSDpHNO_in2UbkAajamqyYtn5NIoMsDHYd85LdCP4p3yygK4nifKCmaor2DJocH4x3ArOuUwvCRTmxJMf2laewk0LEEmoELKAM0KmTDgj9Gi4CB0TNlZLXsWjK3o63HL2rEKOLA95qRwajPWWWucLXZLvc91l5Nrc53L4vBR0oLx5w4J0KpGTgcm0qFnkCEagp1mmTAwmLVxyv7Iy6XovF-40T2mNC3a_uL3iGHjm6MEv0CX5XyL1kspOg5tomB59rOix_Lp7LFK4S';
        $id = '49e8a0e3f9a610f849b7';
           $client = new \GuzzleHttp\Client();
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
            return view('test.components.edit-article',compact('oa_info','title','article'));
         }
    }
    public function updateArticle(Request $request)
    {
             $accessToken = 'AEma5D8bHXGgwoWNrY1F4o7cAnVSDpHNO_in2UbkAajamqyYtn5NIoMsDHYd85LdCP4p3yygK4nifKCmaor2DJocH4x3ArOuUwvCRTmxJMf2laewk0LEEmoELKAM0KmTDgj9Gi4CB0TNlZLXsWjK3o63HL2rEKOLA95qRwajPWWWucLXZLvc91l5Nrc53L4vBR0oLx5w4J0KpGTgcm0qFnkCEagp1mmTAwmLVxyv7Iy6XovF-40T2mNC3a_uL3iGHjm6MEv0CX5XyL1kspOg5tomB59rOix_Lp7LFK4S';
        $id = '49e8a0e3f9a610f849b7';
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
             $result = $client->request('POST','https://openapi.zalo.me/v2.0/article/update?access_token='.$accessToken,[
                'body'=>$data
         ]);
         $response = json_decode($result->getBody());


         $oa_info = session('oa_info');
         $title = "Chỉnh sửa bài viết";
                return redirect('test/edit-article');
    }
    public function searchBroadcast()
    {
           $oa_info = session('oa_info');
         $title = "Chỉnh sửa bài viết";
        return view('test.components.search-broadcast',compact('oa_info','title'));
    }
        public function searchBroadcast2(Request $request)
    {
        // $start = strtotime($request->st);
        // $end = strtotime($request->en);
        $date = $request->daterange;
        $date = explode(' - ',$date);
        $start = strtotime($date[0]);
        $end = strtotime($date[1]);
          $client = new \GuzzleHttp\Client();
        $res = $client->get('https://openapi.zalo.me/v2.0/article/getslice?offset=0&limit=5&type=normal&access_token=-jhyLUMxC2hutV1MuRuvBVFGyrRhgKD0-Sg2LvlL4bVdpwTLhkWEJl68n4oDht1Owh-aVuwbQcRXWyOUd-DSCep3uGZ2urqggFYMAFNsNL2ExlDEq-X1D9sCwJFlzdqsekorCUVNVmUQmxTvtyjt1vAnv2_XbquIh_F-EFF-PZYvtSeXvCHq5PdRn3J-uWmKuiM65l2g7Ig9oD45n-jc9hJExpVwso0qWlcA6uJ27cR2eR5ZW8zzUSY7pW22XWS5aOMc7UAt3o6efhmB-zmtSO3_dqtpx2DrZVISR2jN-KxYepSY');
        $result = json_decode($res->getBody());
        $arr=$result->data->medias;

         $articles = array();
            foreach ($arr as $item) {
                $date =(int)substr((string)$item->create_date,0,10);
                if ($date>=$start && $date<=$end) {
                    array_push($articles, $item);
                }
            }
        dd($articles);
        return response()->json(['start'=>$start,'end'=>$end]);
    }
    public function Broadcast()
    {
        $accessToken = "r-3lHTjGqI3Lv-D6trNO9zxgu4RLGgzGXwASKTfmhZ6ka_fItdYMTTEttXEwO84tqxFU0QXTcXJsYyGthqpy4Et-apQy3-5LvS-yHeSQWtsIvhvpsmk4IvR5k7N7TufHXfJbOVrmdbYEbS5uWKIP6EkWsG20Q9zjx9wXVAvjv67dX8HuZ7lzGepEmq_N9vfNYV2yODiCq06pleWtl5dcACgAg2wSNF0TwfAg9UformAWWQuIssx27ukH-IM5UwK1_xQVBPS0mWpsmuWKk1MwATJMn4gg8lbpSJCuXWjKt4ZMA0";

         //$accessToken = 'AEma5D8bHXGgwoWNrY1F4o7cAnVSDpHNO_in2UbkAajamqyYtn5NIoMsDHYd85LdCP4p3yygK4nifKCmaor2DJocH4x3ArOuUwvCRTmxJMf2laewk0LEEmoELKAM0KmTDgj9Gi4CB0TNlZLXsWjK3o63HL2rEKOLA95qRwajPWWWucLXZLvc91l5Nrc53L4vBR0oLx5w4J0KpGTgcm0qFnkCEagp1mmTAwmLVxyv7Iy6XovF-40T2mNC3a_uL3iGHjm6MEv0CX5XyL1kspOg5tomB59rOix_Lp7LFK4S';
            $client = new \GuzzleHttp\Client();
                 $res = $client->get('https://openapi.zalo.me/v2.0/article/getslice',['query'=>[
               'offset'=>0,
               'limit'=>10,
               'type'=>'normal',
               'access_token'=>$accessToken
           ]]);
             $result = json_decode($res->getBody());
       $data = $result->data;
       $total = $data->total;
       $articles = $data->medias;
        $oa_info = session('oa_info');
        $title="Gửi broadcast";
        session(['broadcasts'=>$articles]);

       return view('test.components.broadcast',compact('articles','oa_info','title','total'));
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
        return view('test.components.view-broadcast',compact('broadcast','oa_info','title'));

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
    public function resetDate()
    {
        $html="hehe";
        return response()->json(['success'=>true,'html'=>$html]);
    }
    public function paginate(Request $request)
    {
         $current_page = 1;
        if($request->has('page'))
        {
            $current_page = $request->query('page');
        }
        $limit = 1;
        $offset = ($current_page-1)*$limit;
        // dd($offset);
           $accessToken = 'AEma5D8bHXGgwoWNrY1F4o7cAnVSDpHNO_in2UbkAajamqyYtn5NIoMsDHYd85LdCP4p3yygK4nifKCmaor2DJocH4x3ArOuUwvCRTmxJMf2laewk0LEEmoELKAM0KmTDgj9Gi4CB0TNlZLXsWjK3o63HL2rEKOLA95qRwajPWWWucLXZLvc91l5Nrc53L4vBR0oLx5w4J0KpGTgcm0qFnkCEagp1mmTAwmLVxyv7Iy6XovF-40T2mNC3a_uL3iGHjm6MEv0CX5XyL1kspOg5tomB59rOix_Lp7LFK4S';
        $data =  json_encode(array(
            'offset' => $offset,
            'count' => $limit
        ));
          $client = new \GuzzleHttp\Client();
                 $response = $client->get('https://openapi.zalo.me/v2.0/oa/getfollowers',['query'=>[
                'data'=>$data,
               'access_token'=>$accessToken
           ]]);
        $result = json_decode($response->getBody());
        // dd($result);
        $follower_ids = $result->data->followers;
        $total = $result->data->total;
        $total_page = (ceil($total / $limit));
        $followers = array();
                    // dd($current_page,$total_page);
        $oa_info = session('oa_info');

        $title="Người theo dõi";
       $paginate = $this->paginateTrait('/test/paginate',$current_page,$total_page);

        return view('test.components.paginate',compact('total','paginate','title','oa_info'));
    }
    public function uploadVideo()
    {
        $title = "upload-video";
        $oa_info = session('oa_info');
         return view('test.components.upload-video',compact('title','oa_info'));

    }
    public function uploadingVideo(Request $request)
    {
        // $video = $request->file('video');
        $video = $request->file;
         $accessToken = 'AEma5D8bHXGgwoWNrY1F4o7cAnVSDpHNO_in2UbkAajamqyYtn5NIoMsDHYd85LdCP4p3yygK4nifKCmaor2DJocH4x3ArOuUwvCRTmxJMf2laewk0LEEmoELKAM0KmTDgj9Gi4CB0TNlZLXsWjK3o63HL2rEKOLA95qRwajPWWWucLXZLvc91l5Nrc53L4vBR0oLx5w4J0KpGTgcm0qFnkCEagp1mmTAwmLVxyv7Iy6XovF-40T2mNC3a_uL3iGHjm6MEv0CX5XyL1kspOg5tomB59rOix_Lp7LFK4S';
         $client = new \GuzzleHttp\Client();
                 $response = $client->request('POST','https://openapi.zalo.me/v2.0/article/upload_video/preparevideo',['query'=>[
               'access_token'=>$accessToken
                 ],
             'multipart' => [
        [
            'name'=>'file',
            'filename'=>$video->getClientOriginalName(),
            'contents' =>  fopen($video,'r'),
        ],
           ]]);
    $result = json_decode($response->getBody());

     $response = $client->get('https://openapi.zalo.me/v2.0/article/upload_video/verify',['query'=>[
               'access_token'=>$accessToken,
               'token'=>$result->data->token,
                 ],
             ]);
        $result = json_decode($response->getBody());
        return response()->json(['success'=>true,'result'=>$result]);

        }
}
