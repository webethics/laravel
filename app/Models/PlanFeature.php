<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanFeature extends Model
{
	//use SoftDeletes;
	protected $table = 'plan_features';
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'plan_id',
		'feature_text',
    	'arabic_feature_text'
    ];

   
    
}
