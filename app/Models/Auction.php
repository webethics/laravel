<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Auction extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
    	'category_id',
        'title',
        'slug',
        'short_description',
		'highlights',
		'amount',
        'min_bid',
        'max_bid',
        'sale_no',
		'feature_image',
        'original_feature_image',
        'mimes',
		'start_on',
		'start_time',
		'expire_on',
		'expire_time',
        'status',
		'featured'
    ];

    protected $appends = ['feature_image_url'];

    public function getFeatureImageUrlAttribute()
    {
        if($this->feature_image != NULL)
            return url('/uploads/auctions').'/'. $this->id .'/'. $this->feature_image;
    }

    public function category(){
    	return $this->belongsTo("App\Models\Category");
    }

    public function media()
    {
      return $this->hasMany('App\Models\Media')->orderBy('position');
    }
	
    public function bid()
    {
      return $this->hasMany('App\Models\Bid','lots_id');
    }

}
