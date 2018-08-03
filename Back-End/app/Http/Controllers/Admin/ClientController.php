<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Endroid\QrCode\QrCode;
use App\User;
use App\Country;
use App\Client;
use DB;

class ClientController extends Controller
{

    public function index(){
        $users = User::where('type','CLIENT')->with('client')->paginate(10);
        return view('client.index')->with('users',$users);
    }

    public function create(){
        $countries = Country::all();
        return view('client.create')->with('countries',$countries);
    }

    public function store(request $request){

        $this->validate($request, [
            'name'         => 'required',
            'country_code' => 'required',
            'mobile'       => 'required|numeric',
            'national_id'  => 'required|numeric',
            'country_id'   => 'required|numeric',
            'balance'      => 'required|numeric',
        ]);


    	try{

            DB::beginTransaction();

            // ******* <START CREATE ORDER>
            $user = User::create([
                'name'            => $request->name,
                'country_code'    => $request->country_code,
                'mobile'          => $request->mobile,
                'type' 			  => 'CLIENT',
            ]);
            // ******* </END CREATE ORDER>

            if($user){

            	$qrCode = new QrCode($user->id);
		        header("Content-Type: ".$qrCode->getContentType());
		        $qrCode->writeFile('uploads/qrcodes/qrcode-'.$user->id.'.png');

            	$client = Client::Create([
                    'user_id'     => $user->id,
            		'national_id' => $request->national_id,
            		'country_id'  => $request->country_id,
                    'balance'     => $request->balance,
            		'pin_code'	  => str_random(6),
            		'qr_code'	  => 'qrcode-'.$user->id.'.png',
            	]);

            }

            DB::commit();

        }catch(\Exception $e){       
            
            DB::rollback();
        
        }

        return redirect('/clients');
    	
    }


    public function edit($id){
        $countries = Country::all();
        $user = User::where('id',$id)->with('client')->first();
        return view('client.edit',compact('user','countries'));
    }

    public function update(request $request, $id){


        $this->validate($request, [
            'name'         => 'required',
            'country_code' => 'required',
            'mobile'       => 'required|numeric',
            'national_id'  => 'required|numeric',
            'country_id'   => 'required|numeric',
            'balance'      => 'required|numeric',
        ]);


        try{

            DB::beginTransaction();

            // ******* <START CREATE ORDER>
            $user = User::where('id',$id)->update([
                'name'            => $request->name,
                'country_code'    => $request->country_code,
                'mobile'          => $request->mobile,
            ]);
            // ******* </END CREATE ORDER>

            $client = Client::where('user_id',$id)->update([
                'national_id' => $request->national_id,
                'country_id'  => $request->country_id,
                'balance'     => $request->balance,
            ]);

            DB::commit();

        }catch(\Exception $e){       
            
            DB::rollback();
        
        }

        return redirect('/clients');

    }


}
