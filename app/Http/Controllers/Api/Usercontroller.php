<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LogUserRequest;
use App\Http\Requests\RegisterUser;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class Usercontroller extends Controller
{
    public function register(RegisterUser $request){

        try{
            $user = new User();

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;

            $user->save();

            return response()->json([
                'status_code'=>200,
                'status_message'=>'Utilisateurs enregistres',
                'user'=> $user
            ]);

        }catch(Exception $e){
            return response()->json($e);
        }
    }

    public function login(LogUserRequest $request){
        if(auth()->attempt($request->only(['email', 'password']))){
            $user = auth()->user();

            $token = $user->createToken('MA_CLE_SECRETE_VISIBLE_UNIQUEMENR_AU_BAKEND')->plainTextToken;

            return response()->json([
                'status_code'=>200,
                'status_message'=>'utilisateur connecte',
                'user'=>$user,
                'token'=>$token
            ]);
        }else{
            return response()->json([
                'status_code'=>403,
                'status_message'=>'information non valide'
            ]);
        }
    }
}
