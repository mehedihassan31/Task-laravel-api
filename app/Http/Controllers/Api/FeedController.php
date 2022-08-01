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
        //get following user post
        return  Users::with('PersonFollow.PersonPost')->where('id',Auth::user()->id)->get();

    }
}
