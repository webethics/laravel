<?php

namespace App\Models;
namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Leads extends Model
{
    protected $table = 'leads';

  

    protected $fillable = [
    	'client_name',  
        'upwork_id', 
        'job_title', 
        'job_url',
        'client_budget', 
        'our_estimate', 
        'bidder_id', 
        'status', 
      
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    // public function Upwork_id()
    // {
    // return $this->belongsTo(\App\Models\Upwork_id::class, 'id');    
    // }
    
}
