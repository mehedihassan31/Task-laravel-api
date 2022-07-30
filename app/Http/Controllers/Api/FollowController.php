<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\Follow;
use App\Models\Api\Users;
use App\Models\Api\Pages;
use Auth;

class FollowController extends Controller
{
    public function toFollow($personId=null,$pageId=null){

        $from_user_id=Auth::user()->id;
        $check_person_existOrNot=Users::where('id',$personId)->first();
        $check_page_existOrNot=Pages::where('id',$pageId)->first();

        if($check_person_existOrNot ==true && $personId!=null && $pageId==null){
            $data=Follow::create([
                'follower_user_id'=>$from_user_id,
                'following_user_id'=>$personId,
            ]);

            return response([

                "you are following this person now"
            ]);
        }if($check_page_existOrNot ==true && $pageId!=null && $personId==null){
            $data=Follow::create([
                'follower_user_id'=>$from_user_id,	
                'following_page_id'=>$pageId,
            ]);
            return response([
                "you are following this page now"
            ]);
        }

    }
}
