<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'national_id',
        'country_id',
        'balance',
        'user_id',
        'qr_code',
        'pin_code',
    ];

	protected $with = ['country'];

    protected $hidden = [
        'user_id',
        'pin_code', 
        'country_id',
        'created_at',
        'updated_at',
    ];

    public function setPinCodeAttribute($value){
        $this->attributes['pin_code'] = bcrypt($value);
    }

    public function country(){
    	return $this->belongsTo(Country::class);
    }

    public function getQrCodeAttribute($value){
        return ($value != "") ? URL('/').'/uploads/qrcodes/'.$value : '' ;
    }



}
