<?php

namespace App\Http\Controllers\Api;

use App\Helper\Functions;
use App\Http\Controllers\Api\BaseController;
use App\User;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function index()
    {
        $user = User::where('status','active')->get();

        foreach ($user as $user){
            $user -> image = Functions::getImage('user', $user -> image);
        }

        return $this->success("success",$user);
    }

}
