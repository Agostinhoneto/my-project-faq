<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException as ExceptionsJWTException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth as FacadesJWTAuth;
use PHPOpenSourceSaver\JWTAuth\JWTAuth;
use App\Services\UserService;
use Exception;
use Illuminate\Support\Facades\Crypt;

class AuthController extends Controller
{

    public function __construct(private UserService $userService)
    {
      // $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function index(){
        $result = ['status' => Response::HTTP_OK];
        
        try {
            $result['data'] = $this->userService->getAll(); 
        }   
        catch(Exception $e) {
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

    public function register(UserFormRequest $request)
    {      

        $name = $request->input('name');
        $email = $request->input('email');
        $password = Crypt::encryptString('password');
        $result = ['status' =>200];
        try {
            $result['data'] =  $this->userService->register(
            $name,
            $email,
            $password);
        } catch(Exception $e) {
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
        try {
            $result['data'] = $this->userService->update($id,$name,$email,$password);
        } catch(Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result,$result['status']);
    }

    public function destroy($id){
        $result = ['status' => 200];
        try {
            $result['data'] = $this->userService->deleteById($id);
        }
        catch(Exception $e) {
           return response()->json([
                	'success' => false,
                	'message' => 'nao foi possivel excluir Usuario'. '$erro',
                ]);
        }
        return response()->json($result,$result['status']);
    }

 
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        //valid credential
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50'
        ]);
        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
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
           ], 500);
        }
 	   //Token created, return with success response and jwt token
        return response()->json([
            'success' => true,
            'token' => $token,
        ]);
    }
 
    public function logout(Request $request)
    {
        //valid credential
        $validator = Validator::make($request->only('token'), [
            'token' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }
		//Request is validated, do logout        
        try {
            JWTAuth::invalidate($request->token);
 
            return response()->json([
                'success' => true,
                'message' => 'User has been logged out'
            ]);
        } catch (ExceptionsJWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
 
    public function get_user(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
 
        $user = JWTAuth::authenticate($request->token);
 
        return response()->json(['user' => $user]);
    }
}