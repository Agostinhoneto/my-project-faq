<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException as ExceptionsJWTException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth as FacadesJWTAuth;
use PHPOpenSourceSaver\JWTAuth\JWTAuth;
use App\Services\UserService;
use Exception;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{

     

    public function __construct(private UserService $userService)
    {
       // $this->middleware('auth:api', ['except' => ['login','register','store']]);
       
    }

    public function index()
    {
      
      $result = ['status' => 200];
        
        try{
            $result['data'] = $this->userService->getAll(); 
        }   
        catch(Exception $e){
            $result = [
                'status' => 500,
                'error' =>$e->getMessage()
            ];
        }
        return response()->json($result,$result['status']);
    }

    public function show($id){
        $result = ['status' =>200];
        try{
            $result['data'] = $this->userService->getById($id);
        }
        catch(Exception $e){
            $result = [
                'status' =>500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result,$result['status']);
    }

    public function register(Request $request)
    {      

        $credentials = $request->only('email', 'password');
        
        $validator = Validator::make($credentials, [
            'email' => 'required|unique|email',
            'password' => 'required|string|min:6|max:50'
        ]);
       
        $name = $request->input('name');
        $email = $request->input('email');
        $password = Crypt::encryptString('password');
        $result = ['status' =>200];
        try{
            $result['data'] =  $this->userService->register(
            $name,
            $email,
            $password);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'não foi possível criar email.',
            ], 500);
        }
        return response()->json($result,$result['status']);
    }

    public function update(Request $request,$id)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $email = $request->input('email');
        $password = Crypt::encryptString('password');
        $result = ['status' =>200];
        try{
            $result['data'] = $this->userService->update($id,$name,$email,$password);
        }catch(Exception $e){
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result,$result['status']);
    }

    public function destroy($id){
        $result = ['status' => 200];
        try{
            $result['data'] = $this->userService->deleteById($id);
        }catch(Exception $e){
           return response()->json([
                	'success' => false,
                	'message' => 'não foi possível criar Email.',
                ], 500);
        }
        return response()->json($result,$result['status']);
    }
   
}