<?php

namespace App\Models;

use Carbon\Carbon;
use Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Download extends Model
{
    //use SoftDeletes;
	protected $table = 'user_downloads';
    protected $dates = [
        'created_at',
    ];

    protected $fillable = [
        'user_id', 	 
        'article_id', 	 
        'language', 	 
        'type' 	 
    ];
	
	public function users(){
		return $this->belongsTo("App\Models\User");
	}
	
	public function articles(){
		return $this->hasMany("App\Models\Article",'id','article_id');
	}
	
	public function arabic_articles(){
		return $this->hasMany("App\Models\ArabicArticle",'id','article_id');
	}
	


}
