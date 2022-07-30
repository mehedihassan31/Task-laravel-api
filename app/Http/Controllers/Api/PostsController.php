<?php

namespace App\Http\Controllers\Api;
use App\Models\Api\Posts;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\Pages;
use Auth;

class PostsController extends Controller
{
    public function create(Request $request,$pageId=null){


        $user_id=Auth::user()->id;
        $fields=$request->validate([
            'post_content'=>'required|string',
        ]);
        $response=[
            'message' => 'Successfully Posted'
        ];

        if($pageId!=null){
            $check_page_owner=Pages::where('owner_id',$user_id)->find(1);
            $page_id=$check_page_owner->id;
            if($pageId==$page_id){
                $data=Posts::create([
                    'post_content'=>$fields['post_content'],
                    'user_id'=>$user_id,
                    'page_id'=>$pageId,
                ]);
                return response($response, 201);
            }else{
                return response([
                    'message'=>'Your are not owner of this page'
                ]);
            }
            
        }else{
            $data=Posts::create([
                'post_content'=>$fields['post_content'],
                'user_id'=>$user_id,
            ]);
            return response($response, 201);
        }

    }


}
