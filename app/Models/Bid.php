<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bid extends Model
{
	use SoftDeletes;
    protected $table = 'bid';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
		'lots_id',
		'bid_number',
		'amount',
		'extra_cost',
		'total_amount'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function auction()
    {
        return $this->belongsTo('App\Models\Auction','lots_id');
    }
    
}
