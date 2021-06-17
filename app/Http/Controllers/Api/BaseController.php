<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class BaseController extends Controller{
    public function success($message, $data){
        return response() -> json([
            'code' => 200,
            'message' => $message,
            'data' => $data
        ], 200);
    }
}
