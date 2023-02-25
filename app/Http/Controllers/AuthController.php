<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use App\Http\Resources\UserResource;
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
use Spatie\Permission\Models\Role;

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
                'status' =>Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' =>$e->getMessage()
            ];
        }
        return response()->json($result,$result['status']);
    }

    public function show($id){
        $result = ['status' =>Response::HTTP_OK];
        try{
            $result['data'] = $this->userService->getById($id);
        }
        catch(Exception $e){
            $result = [
                'status' =>Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result,$result['status']);
    }

    public function register(UserFormRequest $request)
    {      

        $user = User::create([
            'name' =>$request->name,
            'email' =>$request->email,
            'password' =>bcrypt($request->password)
        ]);
        $user_role = Role::where(['name' => 'admin'])->first();
        if ($user_role){
            $user->assignRole($user_role);
        }

        return new UserResource($user);

        /*
        $name = $request->input('name');
        $email = $request->input('email');
        $password = Crypt::encryptString('password');
        $result = ['status' =>Response::HTTP_OK];
        try {
            $result['data'] =  $this->userService->register(
            $name,
            $email,
            $password);
        } catch(Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'não foi possível criar email.',
            ],Response::HTTP_INTERNAL_SERVER_ERROR,
        );
        }
        return response()->json($result,$result['status']);
        */
    }

    public function update(Request $request,$id)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $email = $request->input('email');
        $password = Crypt::encryptString('password');
        $result = ['status' =>Response::HTTP_OK];
        try {
            $result['data'] = $this->userService->update($id,$name,$email,$password);
        } catch(Exception $e) {
            $result = [
                'status' =>Response::HTTP_INTERNAL_SERVER_ERROR, 
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result,$result['status']);
    }

    public function destroy($id){
        $result = ['status' =>Response::HTTP_OK];
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