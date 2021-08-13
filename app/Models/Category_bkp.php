<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	public $timestamps = false;
    protected $table = 'categories';
	 
	protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'category_name',
        'sub_category_name',
        'created_at',
        'updated_at',
    ];
	
}
