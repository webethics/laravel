<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
 
class Blog extends Model
{
   // use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'slug',
        'image',
		'content',
        'original_image',
        'position',
        'mimes',
        'status',
		'auction_cat'
		
    ];


    public function getImageUrlAttribute()
    {
        if($this->image != NULL)
            return url('/uploads/blog').'/'. $this->id .'/'. $this->image;
    }


   
}
