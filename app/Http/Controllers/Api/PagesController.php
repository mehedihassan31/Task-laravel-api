<?php

namespace App\Http\Controllers\Api;
use App\Http\Requests\Pages\Create;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\Pages;
use Illuminate\Validation\ValidationException;
use Auth;

class PagesController extends Controller
{
    public function create(Create $request){
        $owner_id=Auth::user()->id;
        $data=Pages::create([
            'name'=>$request['name'],
            'owner_id'=>$owner_id,
        ]);
        $response=[
            'message' => 'Page Create successfully'
        ];
        return response($response, 201);

    }
}
