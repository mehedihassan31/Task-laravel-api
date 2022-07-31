<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\Follows;
use App\Models\Api\Users;
use App\Models\Api\Pages;
use Auth;

class FollowController extends Controller
{
    public function toFollow($personId=null){

        $from_user_id=Auth::user()->id;
        $check_person_existOrNot=Users::where('id',$personId)->first();
        $check_already_following=Follows::where('follower_user_id',$from_user_id)->where('following_user_id',$personId)->first();
        
        if($check_person_existOrNot ==true &&$check_already_following !=true  && $personId!=null  && $personId!=$from_user_id){
            $data=Follows::create([
                'follower_user_id'=>$from_user_id,
                'following_user_id'=>$personId,
            ]);
            return response([
                "You are following this person now"
            ]);
        }
        return response([
            "The person is not exist or you can not follow yourself or you are Already Follower"
        ]);

    }

    public function toFollowPage($pageId=null){

        //get user id from auth
        $from_user_id=Auth::user()->id;

        //checking user exist or not
        $check_page_existOrNot=Pages::where('id',$pageId)->first();
        $check_already_following=Follows::where('follower_user_id',$from_user_id)->where('following_page_id',$pageId)->first();
        
        $owner_id=$check_page_existOrNot->owner_id;

        if($check_page_existOrNot ==true && $check_already_following !=true  && $pageId!=null && $owner_id!=$from_user_id){
            $data=Follows::create([
                'follower_user_id'=>$from_user_id,	
                'following_page_id'=>$pageId,
            ]);
            return response([
                "You are following this page now"
            ]);
        }
        return response([
            "This page is not exist or you are owner of this page or Already Follower"
        ]);
    }



}
