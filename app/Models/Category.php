<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
 
class Category extends Model
{
    use SoftDeletes; 

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
		'auction_cat',
		'auction_location',
        'slug',
        'image',
		'description',
        'original_image',
        'position',
        'mimes',
        'sale_start_on',
        'sale_end_on',
        'status'
    ];

    protected $appends = ['image_url','is_past','diff_days','title_upper','title_down'];

    public function getImageUrlAttribute()
    {
        if($this->image != NULL)
            return url('/uploads/categories').'/'. $this->id .'/'. $this->image;
    }

    public function getIsPastAttribute()
    {
        $isPast = 'No';
        //if($this->sale_start_on != NULL){
        if($this->sale_end_on != NULL){
            $date = Carbon::parse($this->sale_end_on);
            if($date->isPast()){
               $isPast = 'Yes';
            }
        }
        return $isPast;
    }

    public function getDiffDaysAttribute()
    {
        $date = Carbon::parse($this->sale_start_on);
        return $date->diffInDays(\Carbon\Carbon::now());
    }

    public function getTitleDownAttribute(){
        $title = $this->title;
        $titleArr = explode(" ",$title);
        return end($titleArr);
    }

    public function getTitleUpperAttribute(){
        $title = $this->title;
        $titleArr = explode(" ",$title);
        array_pop($titleArr);
        return implode(" ",$titleArr);
    }

    public function auction()
    {
      return $this->hasMany('App\Models\Auction');
    }
}
