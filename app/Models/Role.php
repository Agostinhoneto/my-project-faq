<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;
use App\Models\User;
use App\Models\Group;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'guard_name',
    ];
    
    public function users(){
        return $this->belongsToMany(User::class,'user_role');
    }
    public function permissions(){
        return $this->belongsToMany(Permission::class,'role_permission');
    }
    public function groups(){
        return $this->hasMany(Group::class);
    }
}
