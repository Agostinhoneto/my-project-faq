<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helper;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
       
       if(!Auth::attempt($request->only('email','password')))
       {
            Helper::sendError('email errado ou senha');
       }

       return new UserResource(auth()->user());

        /*
        $credentials = $request->only('email', 'password');
        //valid credential
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) 
        {
            return response()->json(['error' => $validator->messages()],
            Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        //Request is validated
        //Crean token
        try {
            if (!$token = FacadesJWTAuth::attempt($credentials)) {
                return response()->json([
                	'success' => false,
                	'message' => 'Credenciais Invalidas.',
                ], 400);
            }
        } catch (ExceptionsJWTException $e) {
            return response()->json([
              	'success' => false,
               	'message' => 'não foi possível criar Token.',
           ], );
        }
 	   //Token created, return with success response and jwt token
        return response()->json([
            'success' => true,
            'token' => $token,
        ]);
          */
    }     
}

