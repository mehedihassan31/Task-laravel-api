<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\Create;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Api\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Create $request){
        //insert user data 

        $user=Users::create([
            'first_name'=>$request['first_name'],
            'last_name'=>$request['first_name'],
            'email'=>$request['email'],
            'password'=>bcrypt($request['password'])
        ]);
            
        $token=$user->createToken('myToken')->plainTextToken;
        $response= [
            'user'=>$user,
            'token'=>$token
        ];
    
        return response($response,201);
    }

    public function login(LoginRequest $request){
        // Check email
        $user = Users::where('email', $request['email'])->first();
        // Check password
        if(!$user || !Hash::check($request['password'], $user->password)) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $user->createToken('myToken')->plainTextToken;
        $response = [
                    'user' => $user,
                    'token' => $token
                ];

        return response($response, 200);
    }
      
}
