<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
        
    public function users(){
        return $this->belongsToMany(User::class,'user_group');
    }
    public function role(){
        return $this->belongsTo(Role::class);
    }
}
