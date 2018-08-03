<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBranchTransaction extends Model
{

    protected $fillable = [
        'user_id',
        'branch_id',
        'balance',
        'type',
    ];

    protected $hidden = [
    	'user_id',
    	'branch_id',
    ];

    protected $with = [
    	//'user',
    	'branch',
    ];

    public function branch(){
    	return $this->belongsTo(Branch::class);
    }

    /*public function user(){
    	return $this->belongsTo(User::class)->with('client');
    }*/

}
