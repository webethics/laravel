<?php

namespace App\Models;
namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Hrmenu extends Model
{
    protected $table = 'employee_table';

  

    protected $fillable = [ 
        'emp_id', 
    	'emp_name',  
        'father_name', 
        'personal_email', 
        'professional_email',
        'phone', 
        'current_address', 
        'permanent_address', 
        'date_of_joining',   
        'date_of_birth', 
        'current_salary', 
        'category', 
        'pan_details', 
        'epfo_details', 
        'esi_details', 
        'bank_account', 
        'ifsc_code', 
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

  
}
