<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function getFlagAttribute($value){
        return ($value != "") ? URL('/').'/uploads/countries/'.$value : '' ;
    }

}
