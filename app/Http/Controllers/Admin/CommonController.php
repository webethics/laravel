<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Auction;
use Config;
class CommonController extends Controller
{
	
	
	public function __construct()
    {
	    
    }
/*===============================================
      OPEN CONFIRM BOX TO COMPLETE THE REPROT 
==============================================*/	
    public function confirmModal(Request $request)
	{
	  
	 $roleIdArr = Config::get('constant.role_id');
	 $confirm_message =$request->confirm_message;
	 $confirm_message_1 =$request->confirm_message_1;
	 $leftButtonName =$request->leftButtonName;
	 $leftButtonId =$request->leftButtonId;
	 $leftButtonCls =$request->leftButtonCls;
	 $language =$request->language;
	 $id = $request->id;
	 if ($request->ajax()) {
		return view('modal.confirmModal', compact('id','confirm_message','confirm_message_1','leftButtonName','leftButtonId','leftButtonCls','language'));
	 } 

	}
	/** Create Slug
     * @param $title
     * @param $model
     * @param int $id
     * @return string
     * @throws \Exception
     */
    public static function createSlug($title,$model,$id = 0)
    {
        // Normalize the title
        $slug = Str::slug($title);

        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        if($model == 'auction')
            $allSlugs = CommonController::getRelatedAuctionSlugs($slug, $id);
        else
            $allSlugs = CommonController::getRelatedCategorySlugs($slug, $id);

        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }

        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }

        throw new \Exception('Can not create a unique slug');
    }

    /*Check if no other have same slug*/
    public static function getRelatedCategorySlugs($slug, $id = 0)
    {
        return Category::select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }

    /*Check if no other have same slug*/
    public static function getRelatedAuctionSlugs($slug, $id = 0)
    {
        return Auction::select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }
	
}