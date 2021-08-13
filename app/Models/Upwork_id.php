<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Upwork_id extends Model
{
    
    protected $table = 'upwork_account';

  

    protected $fillable = [
    	'upwork_id_name',  
       
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
