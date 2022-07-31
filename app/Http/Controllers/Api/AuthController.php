<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request){
        

        // Check validation
        $fields=$request->validate([
            'first_name'=>'required|string',
            'last_name'=>'required|string',
            'email'=>'required|string|unique:users,email',
            'password'=>'required|string|confirmed'

        ]);

        //insert user data 

        $user=Users::create([
            'first_name'=>$fields['first_name'],
            'last_name'=>$fields['first_name'],
            'email'=>$fields['email'],
            'password'=>bcrypt($fields['password'])
        ]);
            
        $token=$user->createToken('myToken')->plainTextToken;
        $response= [
            'user'=>$user,
            'token'=>$token
        ];
    
        return response($response,201);
        
    }

    public function login(Request $request){

        // Check validation
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = Users::where('email', $fields['email'])->first();

        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }


        $token = $user->createToken('myToken')->plainTextToken;
        $response = [
                    'user' => $user,
                    'token' => $token
                ];

        return response($response, 201);

    }

      
}
