<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserStoreTransaction;
use App\UserBranchTransaction;
use App\User;
use Auth;
use File;
use Hash;

class UserController extends Controller
{

    public function getStoreTransactions(request $request){

    	$user = Auth::guard('api')->user();

    	$UserStoreTransactions = UserStoreTransaction::where('user_id',$user->id);

    	if($request->status){
    		$UserStoreTransactions = $UserStoreTransactions->where('status',$request->status);
    	}

    	$UserStoreTransactions = $UserStoreTransactions->get();

    	$response['data'] = $UserStoreTransactions;

    	return response()->json($response);

    }

    public function getBranchTransactions(){

    	$user = Auth::guard('api')->user();
    	$UserBranchTransactions = UserBranchTransaction::where('user_id',$user->id)->get();

    	$response['data'] = $UserBranchTransactions;

    	return response()->json($response);

    }

    public function confirmStoreTransaction(request $request, $id){

    	$user = Auth::guard('api')->user();

    	// ******** START VALIDATION
        $validation = $this->validation($request->all(),[
            'pin_code'   => 'required|string',
            'status'	 => 'required|in:ACCEPTED,REJECTED'
        ]);
        if($validation != "true"){ return $validation; }
        // ******** END VALIDATION

        // ********* START CHECK OLD PINCODE = NEW PINCODE
        if(!Hash::check($request->pin_code, $user->client->pin_code)){
            $response['isSuccess'] = false;
            $response['message']   = "pin code incorrect";
            return response()->json($response);
        }
        // ********* END CHECK OLD PINCODE = NEW PINCODE

        $UserStoreTransaction = UserStoreTransaction::find($id);

        if($UserStoreTransaction->status == 'REJECTED' AND $request->status == 'ACCEPTED'){
        	$response['isSuccess'] = false;
	        $response['message']   = "you have been rejected this transaction before";
	        return response()->json($response);
        }

        if($UserStoreTransaction->status == 'ACCEPTED' AND $request->status == 'ACCEPTED'){
        	$response['isSuccess'] = false;
	        $response['message']   = "you have been accepted this transaction before";
	        return response()->json($response);
        }

        $UserStoreTransaction->status = $request->status;
        $UserStoreTransaction->save();

        $response['isSuccess'] = true;
        $response['message']   = "success";
        return response()->json($response);

    }


    public function updateImage(request $request){
    	
    	$user = Auth::guard('api')->user();

    	// ******** START VALIDATION
        $validation = $this->validation($request->all(),[
            'image'   => 'required|string'
        ]);
        if($validation != "true"){ return $validation; }
        // ******** END VALIDATION

    	 //******* START UPLOAD IMAGE BASE64
        if($request->image != "" && base64_decode($request->image, true)){

            // ******** START CHECK SIZE OF BASE64 IMAGE
            $size_in_bytes = (int) (strlen(rtrim($request->image, '=')) * 3 / 4);
            $size_in_kb    = (int) $size_in_bytes / 1024;
            $size_in_mb    = (int) $size_in_kb / 1024;
            if($size_in_kb > 500){
                $response['message'] = 'invalid data';
                $response['error']['image'] = "image shoud be less than 500 KB";
                return response()->json($response,400);
            }
            // ******** END CHECK SIZE OF BASE64 IMAGE

        	// ******** START DELETE OLD IMAGE
            $deleteOldImage = explode('/', $user->image);
            $deleteOldImage = end($deleteOldImage);
        	// ******** END DELETE OLD IMAGE

        	// ******** START UPLOAD NEW IMAGE
	        $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->image));
	        $newImage = uniqid().'.jpg';
	        $user->image = $newImage;
        	// ******** END UPLOAD NEW IMAGE

        	if($user->save()){

        		File::delete('uploads/users/'.$deleteOldImage); // DELETE OLD IMAGE
        		$uploadImg = file_put_contents('uploads/users/'.$newImage, $data); // UPLOAD NEW IMAGE

        		$user = User::find($user->id)->with('client')->first();

        		$response['isSuccess'] = true;
	            $response['message']   = "success";
	            $response['user']      = $user;
	            return response()->json($response,200);

        	}

        	$response['isSuccess'] = false;
            $response['message']   = "error";
            return response()->json($response,200);

        }
        //******* END UPLOAD IMAGE BASE64

        $response['isSuccess'] = false;
            $response['message']   = "error";
            return response()->json($response,200);

    }

    public function updatePinCode(request $request){
    	
    	$user = Auth::guard('api')->user();

    	// ******** START VALIDATION
        $validation = $this->validation($request->all(),[
            'old_pin_code'   => 'required|string|max:191',
            'new_pin_code'   => 'required|string|max:191',
            'new_pin_code_2' => 'required|string|max:191',
        ]);
        if($validation != "true"){ return $validation; }
        // ******** END VALIDATION

        // ********* START CHECK OLD PINCODE = NEW PINCODE
        if(!Hash::check($request->old_pin_code, $user->client->pin_code)){
        //if($request->old_pin_code != $user->client->pin_code){
            $response['isSuccess'] = false;
            $response['message']   = "old pin code incorrect";
            return response()->json($response);
        }
        // ********* END CHECK OLD PINCODE = NEW PINCODE

        if($request->new_pin_code != $request->new_pin_code_2){
        	$response['isSuccess'] = false;
        	$response['message'] = 'new pin code not matches';
        	return response()->json($response);
        }

        $user->client->pin_code = $request->new_pin_code;
        $user->client->save();

        $response['isSuccess'] = true;
    	$response['message'] = 'pincode has been updated';
    	return response()->json($response);

    }

}
