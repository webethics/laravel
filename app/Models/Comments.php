<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'comments';

    protected $dates = [
        'created_at',
        'updated_at',
    ];


    protected $fillable = [
    	'user_id',
        'comment_content', 
       
    ];
}
