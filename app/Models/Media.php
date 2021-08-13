<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
    	'auction_id',
        'image',
        'original_image',
        'position',
        'mimes',
        'status'
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        if($this->image != NULL)
            return url('/uploads/auctions').'/'. $this->auction_id .'/'. $this->image;
    }

    public function auction(){
    	return $this->belongsTo("App\Models\Auction")->orderBy('position');
    }
}
