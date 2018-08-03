<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{

	protected $fillable = [
		'name',
		'description',
		'mobile',
		'email',
		'commercial_registration',
		'tax_card',
		'image',
		'balance',
	];

	protected $attributes = [
		'balance' => 0,
	];

    protected $hidden = [
    	'balance',
    	'tax_card',
    	'commercial_registration',
    ];

    public function getImageAttribute($value){
        return ($value != "") ? URL('/').'/uploads/stores/'.$value : '' ;
    }

}
