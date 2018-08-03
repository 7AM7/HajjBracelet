<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserStoreTransaction extends Model
{
    
    protected $fillable = [
        'store_id',
        'user_id',
        'type',
        'status',
        'balance',
    ];

    protected $with = [
    	//'user',
    	'store',
    ];

    protected $hidden = [
    	'user_id',
    	'store_id',
    ];

    /*public function user(){
    	return $this->belongsTo(User::class)->with('client');
    }*/

    public function store(){
    	return $this->belongsTo(Store::class);
    }


}
