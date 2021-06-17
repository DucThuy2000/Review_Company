<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'description', 'permissions'];

    public function users(){
        return $this -> belongsToMany("App\User", "role_user","id_role", "id_user");
    }
}
