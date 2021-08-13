<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bidder extends Model
{
    protected $table = 'bidder';

    protected $dates = [
        'created_at',
        'updated_at',
    ];


    protected $fillable = [
    	'bidder_name',  
    ];
}
