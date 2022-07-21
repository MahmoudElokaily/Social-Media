<?php

namespace App\traits;


Trait responseTrait {
    public function response($user = null, $message = '' , $token = '' , $status){
        $response = [
            'user' => $user,
            'message' => $message,
            'token' => $token,
        ];
        return response()->json($response , $status);
    }
}
