<?php

namespace App\Http\Controllers\Api;
use App\Models\Api\Posts;
use App\Http\Requests\Posts\Create;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\Pages;
use Auth;

class PostsController extends Controller
{
    protected $title = [];

    public function __construct(){
        $this->title  = [
            '0' => 'Successfully Posted',
            '1'=>'Your are not owner of this page'
        ];
    }

    public function create(Create $request,$pageId=null){
        $user_id=Auth::user()->id;
        if($pageId!=null){
            $check_page_owner=Pages::where('owner_id',$user_id)->first();
            $page_id=$check_page_owner->id;
            if($pageId==$page_id){
                $data=Posts::create([
                    'post_content'=>$request['post_content'],
                    'user_id'=>$user_id,
                    'page_id'=>$pageId,
                ]);
                return response([
                    'message'=> $this->title['0']
                ], 201);
            }else{
                return response([
                    'message'=> $this->title['1']
                ]);
            }
            
        }else{
            $data=Posts::create([
                'post_content'=>$request['post_content'],
                'user_id'=>$user_id,
            ]);
            return response([
                'message'=> $this->title['0']
            ], 201);
        }

    }


}
