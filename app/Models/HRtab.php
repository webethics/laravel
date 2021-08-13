<?php

namespace App\Models;
namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class HRtab extends Model
{
    protected $table = 'hr_table';

  

    protected $fillable = [ 
        'tech_stack', 
    	'past_experience',  
        'past_companies', 
        'tele_verification', 
        'email_verification',
        'hired_through', 
        'hired_on', 
        'increment_due', 
        'leaving_date',   
        'education', 
        'comments', 
       
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
