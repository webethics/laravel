<?php

namespace App\Models;

use Carbon\Carbon;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Subscription extends Authenticatable
{
    use SoftDeletes;

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id', 	 
        'subscription_id', 	 
        'plan_id', 	 
        'plan_price', 	 
        'payer_name', 	 
        'payer_mail', 	 
        'payer_id', 	 
        'status', 	 
        'subscription_start', 	 
        'subscription_end', 
		'paymentMethod',		
    ];
	
	public function users(){
		return $this->belongsTo("App\Models\User");
	}
	
	public function plan(){
		return $this->belongsTo("App\Models\Plan",'plan_id','stripe_plan_id');
	}
	


}
