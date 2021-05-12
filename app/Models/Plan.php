<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
	//use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'arabic_title',
        'slug',
        'price',
		'description',
		'arabic_description',
		'display_order',
		'plan_id',
		'num_of_users',
		'status',
		'mem_length'
    ];

   
    public function features()
    {
    	return $this->hasMany('App\Models\PlanFeature','plan_id');
    }
}
