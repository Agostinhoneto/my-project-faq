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
    }     
}

