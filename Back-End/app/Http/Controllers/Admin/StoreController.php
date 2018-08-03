<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Store;
use DB;
use File;
use App\User;
use App\StoreAdmin;

class StoreController extends Controller
{
    public function index(){
        $stores = Store::paginate(10);
        return view('store.index')->with('stores',$stores);
    }

    public function create(){
    	return view('store.create');
    }

    public function store(request $request){

        $this->validate($request, [
            'name'         => 'required|string|max:191',
            'description'  => 'nullable|string|max:191',
            'image'		   => '',
            'email' 	   => 'nullable|email|string|max:191',
            'mobile'       => 'nullable|string',
            'commercial_registration'  => 'nullable|string',
            'tax_card'    => 'nullable|string',

            'user_name'         => 'required|string',
            'user_country_code' => 'required|string',
            'user_mobile'    	=> 'required|numeric',
        ]);


    	try{

            //DB::beginTransaction();

            $image = '';

            if($request->image){
	            $image = time().".".$request->image->getClientOriginalExtension();
	            $request->image->move(public_path('uploads/stores/'),$image);
	        }

            // ******* <START CREATE ORDER>
            $store = Store::create([
                'name'          => $request->name,
                'description'   => $request->description,
                'mobile'        => $request->mobile,
                'email' 		=> $request->email,
                'commercial_registration' => $request->commercial_registration,
                'tax_card' 		=> $request->tax_card,
                'image'			=> $image,
            ]);
            // ******* </END CREATE ORDER>

            // START CREATE STORE ADMIN
            $user = User::create([
            	'name'		   => $request->user_name,
            	'country_code' => $request->user_country_code,
            	'mobile'       => $request->user_mobile,
            	'password'	   => $request->user_password,
            	'type'		   => 'STORE',
            ]);

            $storeUser = StoreAdmin::create([
            	'user_id'	=> $user->id,
            	'store_id'	=> $store->id,
            	'type'      => 'SUPER_ADMIN',
            ]);
            // END CREATE STORE ADMIN


            //DB::commit();

        }catch(\Exception $e){ /*     
            
            DB::rollback();
        
        */}

        return redirect('/stores');
    	
    }

    public function edit($id){
    	$store = Store::where('id',$id)->first();
    	return view('store.edit')->with('store',$store);
    }

    public function update(request $request, $id){

        $this->validate($request, [
            'name'         => 'required|string|max:191',
            'description'  => 'nullable|string|max:191',
            'image'		   => '',
            'email' 	   => 'nullable|email|string|max:191',
            'mobile'       => 'nullable|string',
            'commercial_registration'  => 'nullable|string',
            'tax_card'    => 'nullable|string',
        ]);

        $store = Store::find($id);

    	try{

            DB::beginTransaction();

            if($request->image){

            	// Delete the old picture
	            $deleteOldImage = explode('/', $store->image);
	            $deleteOldImage = end($deleteOldImage);
	            File::delete('uploads/stores/'.$deleteOldImage);

	            $image = time().".".$request->image->getClientOriginalExtension();
	            $request->image->move(public_path('uploads/stores/'),$image);
	        }else{
            	$image = $store->image;
	        }

            // ******* <START CREATE ORDER>
            $store->update([
                'name'          => $request->name,
                'description'   => $request->description,
                'mobile'        => $request->mobile,
                'email' 		=> $request->email,
                'commercial_registration' => $request->commercial_registration,
                'tax_card' 		=> $request->tax_card,
                'image'			=> $image,
            ]);
            // ******* </END CREATE ORDER>


            DB::commit();

        }catch(\Exception $e){       
            
            DB::rollback();
        
        }

        return redirect('/stores');
    	
    }
 
}
