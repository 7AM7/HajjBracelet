<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $hidden = [
    	'balance',
    ];

    public function getImageAttribute($value){
        return ($value != "") ? URL('/').'/uploads/stores/'.$value : '' ;
    }
    
}
