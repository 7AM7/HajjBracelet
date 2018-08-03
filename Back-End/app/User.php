<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $fillable = [
        'name',
        'country_code',
        'mobile',
        'password',
        'type',
        'code',
    ];

    protected $hidden = [
        'password', 
        'remember_token',
        'code',
        'type',
        'created_at',
        'updated_at',
    ];

    public function client(){
        return $this->hasOne(Client::class);
    }

    public function storeAdmin(){
        return $this->hasOne(StoreAdmin::class);
    }


    public function branchAdmin(){
        return $this->hasOne(BranchAdmin::class);
    }

    public function getImageAttribute($value){
        return ($value != "") ? URL('/').'/uploads/users/'.$value : '' ;
    }


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }




}
