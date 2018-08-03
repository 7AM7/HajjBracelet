<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\StoreAdmin;

class StoreAdminController extends Controller
{
    public function index(){
    	$users = User::where('type','STORE')->paginate(10);
        return view('storeadmin.index')->with('users',$users);
    }

    public function create(){
    	return view('storeadmin.create');
    }

    public function store(request $request, $id){
    	
    	$this->validate($request, [
            'name'         => 'required|string',
            'country_code' => 'required|string',
            'mobile'       => 'required|numeric|unique:users',
            'type'         => 'required|in:ADMIN,SUPER_ADMIN',
        ]);


        $user = User::create([
        	'name' 		   => $request->name,
        	'country_code' => $request->country_code,
        	'mobile' 	   => $request->mobile,
        	'type'  	   => 'STORE',
        ]);

        if($user){
        	$storeAdmin = StoreAdmin::create([
        		'user_id'  => $user->id,
        		'store_id' => $id,
        		'type' 	   => $request->type,
        	]);
        }

        return redirect('/stores/'.$id.'/admins');

    }

    public function edit($id,$adminId){
    	$user = User::where('id',$adminId)->with('storeAdmin')->first();
    	return view('storeadmin.edit')->with('user',$user);
    }


    public function update(request $request, $id, $adminId){
    	
    	$this->validate($request, [
            'name'         => 'required|string',
            'country_code' => 'required|string',
            'mobile'       => 'required|numeric|unique:users,mobile,'.$adminId,
            'type'         => 'required|in:ADMIN,SUPER_ADMIN',
        ]);


        $user = User::where('id',$adminId)->update([
        	'name' 		   => $request->name,
        	'country_code' => $request->country_code,
        	'mobile' 	   => $request->mobile,
        ]);

        if($user){
        	$storeAdmin = StoreAdmin::where('user_id',$adminId)->where('store_id',$id)->update([
        		'type' 	   => $request->type,
        	]);
        }

        return redirect('/stores/'.$id.'/admins');

    }

}
