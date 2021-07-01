<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AuthRequest;
use App\Models\User;

class AuthController extends Controller
{
    //
    public function register(AuthRequest $request){
         $user = User::create([
             'name' => $request['name'],
             'email' => $request['email'],
             'password' =>bcrypt($request['password']),
         ]);

         $token =$user->createToken('myapptoken')->plainTextToken;

         $response = [
             'user' => $user,
             'token' => $token, 
         ];
         return response($response,201);
    }
    public function login(Request $request){


        $fields =$request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);


        $user = User::where('email',$fields['email'])->first();
        if(!$user | !Hash::check($fields['password'], $user->password)){
            return response([
                'message' => 'Bad creds'
            ],401);
        }

        $token =$user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token, 
        ];
        return response($response,201);
   }
    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Logged Out'
        ];
    }
}
