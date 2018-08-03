<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\StoreBranchTransaction;
use App\Store;
use Auth;
use App\User;
use DB;

class StoreBranchTransactionController extends Controller
{
    public function index($storeId){
    	$transactions = StoreBranchTransaction::where('store_id',$storeId)->paginate(10);
    	return view('storeBranchTransaction.index')->with('transactions',$transactions);
    }

    public function create($storeId){
    	$store = Store::find($storeId);
    	return view('storeBranchTransaction.create')->with('store',$store);
    }

    public function store(request $request, $storeId){
    	
        $store = Store::find($storeId);

    	$this->validate($request, [
            'amount' => 'required|numeric|max:'.$store->balance,
        ]);

    	$user = User::where('id',Auth::user()->id)->with('branchAdmin')->first();

	    try{

            DB::beginTransaction();

	        $storeBranchTransaction = StoreBranchTransaction::create([
	        	'store_id'  => $storeId,
	        	'branch_id' => $user->branchAdmin->branch_id,
	        	'balance'   => $request->amount,
	        	'type'		=> 'PAY',
	        	'status'    => 'DONE',
	        ]);

	        $store->balance -= $request->amount;
	        $store->save();

        DB::commit();

        }catch(\Exception $e){       
            
            DB::rollback();
        
        }

		return redirect('/stores/'.$storeId.'/transactions');
    }
    
}
