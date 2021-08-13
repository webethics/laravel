<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeCategory extends Model
{
    protected $table = 'employee_category';

    protected $dates = [
        'created_at',
        'updated_at',
    ];


    protected $fillable = [
    	'category_name',  
    ];
}
