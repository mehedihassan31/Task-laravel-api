<?php

namespace App\Http\Controllers\Api;
use App\Models\Api\Posts;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function create(Request $request){

        

        $user_id=Auth::user()->id;
        $fields=$request->validate([
            'post_content'=>'required|string',
        ]);

        $data=Posts::create([
            'post_content'=>$fields['post_content'],
            'user_id'=>$user_id,
        ]);

        $response=[
            'message' => 'Successfully Posted'
        ];

        return response($response, 201);

    }


}
