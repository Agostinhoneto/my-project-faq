<?php
namespace App\Http\Helpers;
use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\Exceptions\HttpResponseException as ExceptionsHttpResponseException;

class Helper{

    public static function sendError($message, $errors=[], $code = 401)
    {
        $response = ['sucess' => false,'message'=>$message];
        if(!empty($errors)){
            $response['data'] = $errors;
        }
        throw new ExceptionsHttpResponseException(response()->json($response,$code));
    }
}
