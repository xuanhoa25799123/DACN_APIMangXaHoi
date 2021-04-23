<?php

namespace App\Http\Controllers;

use Goutte\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class TestController extends Controller
{
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
            return view('test.dashboard',compact('profile'));
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
//        dd($friends);
        return view('test.components.friend-list',compact('total','friends','profile'));
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
        return view('test.components.invite-list',compact('total','friends','profile'));
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
        return view('test.components.send-message',compact('receives','profile','sendIds','message','link'));
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
        return view('test.components.send-invite',compact('receives','profile','sendIds','message'));
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
        return view('test.components.post-status',compact('profile','message','link'));
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
        return view('test.components.preview-url',compact('profile'));
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
                    if ($crawler->filterXpath('//meta[@name="og:image"]')->count()) {
                        $image = $crawler->filterXpath('//meta[@name="og:image"]')->attr('content');
                    } elseif ($crawler->filterXpath('//meta[@name="twitter:image"]')->count()) {
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
}
