<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreBranchTransaction extends Model
{
    protected $fillable = [
    	'store_id',
    	'branch_id',
    	'type',
    	'status',
    	'balance',
    ];
}
