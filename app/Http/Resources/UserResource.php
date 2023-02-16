<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
   
    public function toArray($request)
    {
       return [
        'user_id' =>$this->id,
        'name' =>$this->name,
        'email' =>$this->email,
        'token' =>$this->createToken("Token")->plainTextToken,
        'roles' =>$this->roles,
        'permissions' =>$this->permissions
       ];
    }
}
