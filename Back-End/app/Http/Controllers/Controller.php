<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Validator;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function validation($request,$rule,$message = []){
        $validator = Validator::make($request,$rule,$message);
        if ($validator->fails()){
            $errors = $validator->messages()->toArray();
            foreach ($errors as $key => $error) {
                $errorR[$key] = $error[0];
                $message = $error[0];
            }
            return response()->json(['message' => 'invalid data', 'error' => $errorR],400);
        }
        return "true";
    }

}
