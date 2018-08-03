<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Device;
use Auth;

class AuthController extends Controller
{

    // #########################<START LOGIN>#######################

    public function login(request $request){
    	
    	// ******** START VALIDATION
        $validation = $this->validation($request->all(),[
            'country_code'  => 'required|string|max:191',
            'mobile'   	    => 'required|numeric',
        ]);
        if($validation != "true"){ return $validation; }
        // ******** END VALIDATION

        // GET USER QUERY
        $user = User::where('country_code',$request->country_code)
        ->where('mobile', $request->mobile)
        ->where('type','CLIENT')
        ->first();

        // CHECK IF MOBILE IS CORRECT
        if(!$user){
        	$response['status']  = 1;
            $response['message'] = "mobile number incorrect !";
            return response()->json($response,401);
        }

        // GENERATE NEW TOKEN
        //$user->code = str_random(6);
        $user->code = 55555;
        $user->save();

        // RESPONSE 
        $response['isSuccess']  = true;
        $response['message'] 	= 'confirmation code has been sent';
        return response()->json($response,200);

    }

    // #########################<END LOGIN>#######################


    // #########################<START CONFIRM LOGIN>#######################

    public function confirmLogin(request $request){

    	// ******** START VALIDATION
        $validation = $this->validation($request->all(),[
            'country_code'  => 'required|string|max:191',
            'mobile'   	    => 'required|numeric',
            'code'   	    => 'required|string',
            'device_id'     => 'required|string|max:191',
            'fcm_token'		=> 'nullable|string|max:191',
        ]);
        if($validation != "true"){ return $validation; }
        // ******** END VALIDATION

        // GET USER DETAILS
        $user = User::where('country_code',$request->country_code)
        ->where('mobile', $request->mobile)
        ->where('code',$request->code)
        ->where('type','CLIENT')
        ->with('client')
        ->first();

        // ********** START GENERATE TOKEN
        $token = null;

        if (!$user) {
            $response['status']  = 2;
            $response['message'] = "invalid code";
            return response()->json($response,401);
        }
        // ********** END GENERATE TOKEN
        
        //$user->code = null;
        //$user->save();

        $user['token'] = Auth::guard('api')->fromUser($user);
    
        // ********* START UPDATE DEVICE & TOKEN
        $device = Device::updateOrCreate(
            [
                'device_id' => $request->device_id,
            ],
            [
                'user_id'   => $user->id,
                'device_id' => $request->device_id,
                'fcm_token' => $request->fcm_token,
            ]
        );
        // ********* END UPDATE DEVICE & TOKEN

        $response['isSuccess']  = true;
        $response['message'] 	= 'succsess';
        $response['user']  		= $user;
        return response()->json($response,200);

    }

    // #########################<START CONFIRM LOGIN>#######################


}
