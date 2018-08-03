<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserBranchTransaction;
use App\User;
use Auth;
use DB;


class ClientBranchTransactionController extends Controller
{
    
    public function index($userId){
    	$transactions = UserBranchTransaction::where('user_id',$userId)->paginate(10);
    	return view('userBranchTransaction.index')->with('transactions',$transactions);
    }

    public function create($userId){
    	$user = User::find($userId)->with('client')->first();
    	return view('userBranchTransaction.create')->with('user',$user);
    }

    public function store(request $request, $userId){
    	
    	$user = User::find($userId);

    	$rules = [
            'type'   => 'required|in:WITHDRAWAL,DEPOSIT',
        ];
        if($request->type == 'WITHDRAWAL'){
        	$rules['amount'] = 'required|numeric|max:'.$user->client->balance;
        }else{
        	$rules['amount'] = 'required|numeric';
        }
    	$this->validate($request, $rules);

    	$branchAdmin = User::where('id',Auth::user()->id)->with('branchAdmin')->first();

	    //try{

        //    DB::beginTransaction();

	        $userBranchTransaction = UserBranchTransaction::create([
	        	'user_id'   => $userId,
	        	'branch_id' => $branchAdmin->branchAdmin->branch_id,
	        	'balance'   => $request->amount,
	        	'type'		=> $request->type,
	        ]);

	        $user->client->balance = $request->type == 'WITHDRAWAL' ? $user->client->balance - $request->amount : $user->client->balance + $request->amount ;
	        $user->client->save();

        //DB::commit();

        //}catch(\Exception $e){       
            
            //DB::rollback();
        
        //}

		return redirect('/clients/'.$userId.'/transactions');
    }

}
