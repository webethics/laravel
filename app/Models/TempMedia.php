<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TempMedia extends Model
{
    use SoftDeletes;
    protected $table = 'temp_media';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
    	'user_id',
    	'auction_id',
        'image',
        'original_image',
        'position',
        'mimes',
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        if($this->image != NULL)
            return url('/uploads/temp_auctions').'/'. $this->image;
    }
}
