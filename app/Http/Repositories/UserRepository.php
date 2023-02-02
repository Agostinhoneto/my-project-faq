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
    
    public function getAllUser(){
        return $this->user->get();
    }

    public function getById($id){
        return $this->user->where('id',$id)->get();
    }

    public function save($name, $email,$password)
    {
        
        $user = new $this->user;
        $user->name = $name;
        $user->email = $email;
        $user->password = $password;    
        $user->save();
        return $user->fresh();
    }

    public function update($id,$name,$email,$password)
    {   
       
        $user = $this->user->find($id);
        $user->name = $name;
        $user->email = $email;
        $user->password = $password;    
        $user->update();
        return $user->fresh();
    }    

    public function delete($id)
    {
        if($id != null ){
            $user = $this->user->findOrFail($id);
            $user->delete();
        } 
        return $user;  
    }
}
