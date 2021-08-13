<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArabicArticle extends Model
{
	public $timestamps = false;
    protected $table = 'arabic_articles';
	
	protected $dates = [
        'created_at',
        
    ];

    protected $fillable = [
        'title',
        'slug',
        'description',
        'excerpt',
        'is_featured',
        'featured_image',
        'is_protected',
        'status',
        'category',
        'author',
        'meta_title',
        'meta_description',
        'type',
        'created_at',
		'views',
		'files',
		'slideshow',
		'editableFile',
		'files',
      
    ];
	
	
}
