<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreAdmin extends Model
{


    protected $fillable = [
    	'user_id',
    	'store_id',
    	'type',
    ];


    public function user(){
    	return $this->belongsTo(User::class);
    }
}
