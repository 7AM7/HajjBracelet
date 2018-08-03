<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserStoreTransaction;
use Auth;
use App\User;
use App\Store;
use Hash;

class UserStoreTransactionController extends Controller
{
    public function index(){
    	$userId = Auth::user()->id;
    	$storeAdmin = User::where('id',$userId)->with('storeAdmin')->first();

    	$transactions = UserStoreTransaction::where('store_id',$storeAdmin->storeAdmin->store_id)->paginate(10);

    	return view('userStoreTransaction.index')->with('transactions',$transactions);
    }

    public function create(){
    	$userId = Auth::user()->id;
    	$storeAdmin = User::where('id',$userId)->with('storeAdmin')->first();
    	$store = Store::find($storeAdmin->storeAdmin->store_id);

    	return view('userStoreTransaction.create')->with('store',$store);
    }

    public function store(request $request){

    	$userId = Auth::user()->id;
    	$storeAdmin = User::where('id',$userId)->with('storeAdmin')->first();
    	$store = Store::find($storeAdmin->storeAdmin->store_id);

    	$rules = [
            'type' 		=> 'required|in:BUY,RECOVERY',
            'client_id' => 'required|numeric|exists:users,id',
        ];

        if($request->type == 'RECOVERY'){
        	$rules['amount'] = 'required|numeric|max:'.$store->balance;
        }else{
	    	$user = User::where('id',$request->client_id)->first();
	    	if($user){
        		$rules['amount'] = 'required|numeric|max:'.$user->client->balance;
	    	}
        }
    	$this->validate($request, $rules);


    	$transactions = UserStoreTransaction::create([
    		'store_id' => $storeAdmin->storeAdmin->store_id,
    		'user_id'  => $request->client_id,
    		'balance'  => $request->amount,
    		'type'	   => $request->type,
    	]);

    	return redirect('/transactions');

    }


    public function confirmation(request $request, $id){
    	

    	$userStoreTransaction = UserStoreTransaction::find($id);
    	$user = User::where('id',$userStoreTransaction->user_id)->with('client')->first();

        if(!Hash::check($request->pincode, $user->client->pin_code)){
    		return "0";
        }

        if($user->client->balance < $userStoreTransaction->balance){
        	return "0";
        }

        $user->client->balance = $userStoreTransaction->type == 'BUY' ? $user->client->balance - $userStoreTransaction->balance : $user->client->balance + $userStoreTransaction->balance ;
        $user->client->save();

        $store = Store::where('id',$userStoreTransaction->store_id)->first();
        $store->balance = $userStoreTransaction->type == 'BUY' ? $store->balance + $userStoreTransaction->balance : $store->balance - $userStoreTransaction->balance ;
        $store->save();

        $userStoreTransaction->status = 'ACCEPTED';
        $userStoreTransaction->save();

        return "1";   


    }


}
