<?php
namespace App\Http\Repositories;
use App\Models\User;
use Illuminate\Http\Request;


class UserRepository{
    
    protected $user;
    
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    
    public function save($name, $email,$password){
        
        $user = new $this->user;        
        $user->name = $name;
        $user->name = $email;
        $user->password = $password;    
        $user->save();
        return $user->fresh();

        //Request is valid, create new user
      /*  $user = User::create([
        	'name' => $request->name,
        	'email' => $request->email,
        	'password' => bcrypt($request->password)
        ]);

        //User created, return success response
        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user
        ], Response::HTTP_OK);*/
    }
}
