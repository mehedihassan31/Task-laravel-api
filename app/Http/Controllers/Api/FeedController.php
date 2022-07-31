<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\Users;
use App\Models\Api\Posts;
use Auth;

class FeedController extends Controller
{
    public function getFeedData(){
        $user_id=Auth::user()->id;
        //get following user post
        $get_data=Users::with('PersonFollow.PersonPost')->where('id',$user_id)->get();

        return  $get_data;

    }
}
