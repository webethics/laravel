<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\CommonController;
use App\Http\Requests\CreateAuctionRequest;
use App\Http\Requests\UpdateAuctionRequest;
use App\Http\Requests\CreateTempMediaRequest;
use App\Http\Requests\CreateTempLotsFeatureMediaRequest;
use App\Http\Requests\FetchAuctionMediaRequest;
use App\Http\Requests\RemoveAuctionMediaRequest;
use App\Models\Auction;
use App\Models\Category;
use App\Models\TempMedia;
use App\Models\Media;
use App\Models\EmailTemplate;
use App\Models\Bid;
use Config;
use Session;
use Response;
use File;
use Auth;

class AuctionsController extends Controller
{
    protected $per_page;
	public function __construct()
    {
	    
        $this->per_page = Config::get('constant.per_page');
        $this->auction_path = public_path('/uploads/auctions');
        $this->temp_auction_path = public_path('/uploads/temp_auctions');
    }

    public function auction(Request $request)
    {   
    	access_denied_user('auction_listing');

    	//Check if login user images save in temp table then remove it.
    	$this->checkTempMedia();

    	$categories = Category::get();
        
    	$auction_data = $this->auction_search($request,$pagination=true);
		if($auction_data['success']){
			$auctions = $auction_data['auctions'];
			$page_number =  $auction_data['current_page'];
			if(empty($page_number))
				$page_number = 1;
            
           // echo '<pre>';
        //    print_r($auctions);
        //    die;
			if(!is_object($auctions)) return $auctions;
			if ($request->ajax()) {
				return view('admin.auctions.auctionPagination', compact('auctions','page_number','categories'))->render();
			}
			return view('admin.auctions.index',compact('auctions','page_number','categories'));	
		}else{
			return $auction_data['message'];
		}
    }

    public function auction_search($request,$pagination)
	{
		$page_number = $request->page;
		$number_of_records =$this->per_page;
		$title = $request->title;
		$description = $request->description;
		$category = $request->category_id;
		$result = Auction::where(`1`, '=', `1`);
			
		if($title !='' || $description !='' || $category !=''){
			$title_q = '%' . $request->title .'%';
			// check title 
			if(isset($title) && !empty($title)){
				$result->where('title','LIKE',$title_q);
			}
			if(isset($category) && !empty($category)){
				$result->where('category_id','=',$category);
			} 
			
			$description_s = '%' . $description . '%';
			
			// check description 
			if(isset($description) && !empty($description)){
				$result->where('description','LIKE',$description_s);
			}
		}
		
		//echo $result->orderBy('created_at', 'desc')->toSql();die;
		
		if($pagination == true){
			$auctions = $result->orderBy('created_at', 'desc')->paginate($number_of_records);
		}else{
			$auctions = $result->orderBy('created_at', 'desc')->get();
		}
		
		$data = array();
		$data['success'] = true;
		$data['auctions'] = $auctions;
		$data['current_page'] = $page_number;
		return $data;
	}


	/*Get request create view*/
	public function create(){
		$categories = Category::get();
		return view('admin.auctions.auctionForm',compact('categories'));
	}

	/*Store new auction*/
	public function store(CreateAuctionRequest $request){
		$data =array();
		$categoryId = trim($request->category_id);
		$data['category_id']	= trim($categoryId);
		$data['title']	= trim($request->title);
		$data['short_description']	= trim($request->short_description);
		$data['highlights'] = trim($request->description);
		$data['amount'] = trim($request->amount);  
		$data['slug'] = CommonController::createSlug(trim($request->title),'auction');
		$data['min_bid'] = trim($request->min_bid);
		$data['max_bid'] = trim($request->max_bid);
		$data['featured'] = trim($request->is_featured);


		//Generate Sale no by counting number of items that create on this category
		$random_sale_no = $this->generateSaleNo($categoryId);
		if(!empty($random_sale_no))
			$data['sale_no'] = $random_sale_no;
		
		$dat = Auction::create($data);

		$auction_id = $dat->id;

		if(!empty(trim($request->sort_order))){
			//Mark sort
			$this->sortMediaOrderList(trim($request->sort_order));
		}

		if(!empty($auction_id)){
			$feature_image = trim($request->feature_image);
			/*Check feature image save in temp media, then fetch from there otherwise check file*/
			if(!empty($feature_image)){
				$this->saveGalleryMedia($feature_image,$auction_id,1); /*This is save to feature image*/
			}else{
				$image = $request->file('image');
				if(!empty($image)){
					//print_r($image->getClientOriginalExtension());
					//print_r($image->getClientOriginalName());
					$new_name = rand() . '_auction_' . $image->getClientOriginalName();

					//CREATE auction FOLDER IF NOT 
					if (!is_dir($this->auction_path)) {
						mkdir($this->auction_path, 0777);
					}
					//CREATE auction ID FOLDER 
					$auction_id_path = $this->auction_path.'/'.$auction_id;
					if (!is_dir($auction_id_path)) {
						mkdir($auction_id_path, 0777);
					}
					$image->move($auction_id_path, $new_name);
					$auctionUpdate = Auction::where('id',$auction_id);
					$imagedata = array();
					$imagedata['feature_image'] = $new_name;
					$imagedata['original_feature_image'] = $image->getClientOriginalName();
					$imagedata['mimes'] = trim($image->getClientOriginalExtension());			
				    $auctionUpdate->update($imagedata);
				}
			}
			
			$temp_images = trim($request->temp_images);
			if(!empty($temp_images)){
				$this->saveGalleryMedia($temp_images,$auction_id);
			}

		}
		//dd($auction_id);

		Session::flash('success', 'Lot has been Created.');
		//return redirect('admin/auctions/edit/'.$auction_id);
		return redirect('admin/auctions');
	}


	/*Generate Sale No.*/
	public function generateSaleNo($category_id){
		$sale_num = 0;
		$auctions = Auction::where('category_id',$category_id)->get();
		if(!empty($auctions) && count($auctions) > 0){
			$sale_num = count($auctions);
		}

		$sale_num = $sale_num+1;
		return $sale_num;

	}

	/*Mark Order Position of Sort*/
	public function sortMediaOrderList($sortList){
		if(!empty($sortList)){
			$tempArray = explode(",",$sortList);
	    	foreach ($tempArray as $key => $temp) {
	    		if(!empty($temp)){
	    			$data = explode("_",trim($temp));
	    			if(!empty($data[0]) && !empty($data[1])){
	    				if($data[0] == 'media'){
	    					$media = Media::find($data[1]);
	    					if($media){
		    					$media->position=$key+1;
								$media->save();
							}
	    				}else{
	    					$media = TempMedia::find($data[1]);
	    					if($media){
		    					$media->position=$key+1;
								$media->save();
							}
	    				}
	    			}

	    		}
	    	}
		}
	}


	/*Save gallery Media*/
	public function saveGalleryMedia($temp_images,$auction_id,$featureImage=0){
		if(!empty($temp_images)){
	    	$tempArray = explode(",",$temp_images);
	    	foreach ($tempArray as $key => $temp) {
	    		if(!empty($temp)){
	    			$tempMedia = TempMedia::where('id',$temp)->first();
	    			if(!empty($tempMedia)){
	    				$exist_path = $this->temp_auction_path.'/'. $tempMedia->image;
			    		if (file_exists($exist_path)) {
				    		//change file permission
				    		chmod($exist_path, 0777);
				    	
				    		//CREATE auction FOLDER IF NOT 
							if (!is_dir($this->auction_path)) {
								mkdir($this->auction_path, 0777);
							}
							//CREATE auction ID FOLDER 
							$auction_id_path = $this->auction_path.'/'.$auction_id;
							if (!is_dir($auction_id_path)) {
								mkdir($auction_id_path, 0777);
							}
							$destinationPath = $this->auction_path.'/'.$auction_id.'/'.$tempMedia->image;
							File::move($exist_path, $destinationPath);
							chmod($destinationPath, 0777);

							/*Check if feature Image, then save there on auction table*/
							if($featureImage == 1){
								$auctionUpdate = Auction::where('id',$auction_id);
								$imagedata = array();
								$imagedata['feature_image'] = $tempMedia->image;
								$imagedata['original_feature_image'] = $tempMedia->original_image;
								$imagedata['mimes'] =$tempMedia->mimes;			
							    $auctionUpdate->update($imagedata);

							}else{
								$data =array();
								$data['image'] = $tempMedia->image;
								$data['original_image'] = $tempMedia->original_image;
								$data['mimes']	= $tempMedia->mimes;
								$data['position']	= $tempMedia->position;
								$data['auction_id'] = $auction_id;
								$dat = Media::create($data);
							}
							

							//Delete Temp Image
					        @unlink($exist_path);
					        TempMedia::where('id',$temp)->delete();
					    }
	    			}

	    		}
	    		
	    	}

	    }

	}

	/*Edit Request View*/
	public function auction_edit($id){
		access_denied_user('auction_edit');
		$categories = Category::get();
		$auction = Auction::with('media')->where('id',$id)->first();
		//pr($auction->toArray());
		return view('admin.auctions.auctionForm',compact('auction','categories'));
	}

	/*Update auction*/
	public function auction_update(UpdateAuctionRequest $request){
		$auction_id = trim($request->auction_id);
		if(!empty($auction_id)){
			$data =array();
			$data['category_id']	= trim($request->category_id);
			$data['title']	= trim($request->title);
			$data['short_description']	= trim($request->short_description);
			$data['highlights'] = trim($request->description);
			$data['amount'] = trim($request->amount);
			$data['min_bid'] = trim($request->min_bid);
			$data['max_bid'] = trim($request->max_bid);

			$data['featured'] = trim($request->is_featured);

			if(!empty(trim($request->sort_order))){
				//Mark sort
				$this->sortMediaOrderList(trim($request->sort_order));
			}

			$feature_image = trim($request->feature_image);
			/*Check feature image save in temp media, then fetch from there otherwise check file*/
			if(!empty($feature_image)){
				$this->saveGalleryMedia($feature_image,$auction_id,1); /*This is save to feature image*/
			}else{

				$image = $request->file('image');

				if(!empty($image)){
					//print_r($image->getClientOriginalExtension());
					//print_r($image->getClientOriginalName());
					$new_name = rand() . '_auction_' . $image->getClientOriginalName();

					//CREATE auction FOLDER IF NOT 
					if (!is_dir($this->auction_path)) {
						mkdir($this->auction_path, 0777);
					}
					//CREATE auction ID FOLDER 
					$auction_id_path = $this->auction_path.'/'.$auction_id;
					if (!is_dir($auction_id_path)) {
						mkdir($auction_id_path, 0777);
					}
					$image->move($auction_id_path, $new_name);
					
					$data['feature_image'] = $new_name;
					$data['original_feature_image'] = $image->getClientOriginalName();
					$data['mimes'] = trim($image->getClientOriginalExtension());
				}
			}

			$auctionUpdate = Auction::where('id',$auction_id);
			$auctionUpdate->update($data);

			$temp_images = trim($request->temp_images);
			if(!empty($temp_images)){
				$this->saveGalleryMedia($temp_images,$auction_id);
			}

			Session::flash('success', 'Lot edit successfully.');

		}else{
			Session::flash('success', 'Something went wrong, please try again.');
		}
		return redirect('admin/auctions/edit/'.$auction_id);
	}

	/*Delete auction*/
	public function delete_auction(Request $request,$auction_id){
		access_denied_user('auction_delete');
		$data = [];
    	$data['success'] = false;
    	$data['message'] = 'Invalid Request';
		if($auction_id){
			$main_auction  = Auction::where('id',$auction_id)->first();
			if($main_auction){
				Auction::where('id',$auction_id)->delete();

				$auctions_data = $this->auction_search($request,$pagination=true);
				$auctions = [];
				$page_number = 1;
				if($auctions_data['success']){
					$auctions = $auctions_data['auctions'];
					$page_number =  $auctions_data['current_page'];
					if(empty($page_number))
						$page_number = 1;
				}

				$data['success'] = true;
				$data['message'] = 'Successfully Delete Lot.';
				$data['view'] = view('admin.auctions.auctionPagination', compact('auctions','page_number'))->render();

			}else{
				$data['message'] = 'There is no auction found.';
			}
		}
		return Response::json($data, 200);
	}

	public function enableDisableAuction(Request $request){
		if($request->ajax()){
			$auction = Auction::where('id',$request->auction_id);

			$data =array();
			$data['status'] =  $request->status;
			$auction->update($data);
			
			// Show message on the basis of status 
			if($request->status==1)
			 $enable =true ;
			if($request->status==0)
			 $enable =false ;
		  
		   $result =array('success' => $enable);	
		   return Response::json($result, 200);
		}
	}

	public function tempSaveMedia(CreateTempMediaRequest $request){
		if($request->ajax()){
			$image = $request->file('file');
			$user_id = $request->user_id;
			if(!empty($image)){
				//print_r($image->getClientOriginalExtension());
				//print_r($image->getClientOriginalName());
				$new_name = rand() . '_auction_' . $image->getClientOriginalName();

				//CREATE auction FOLDER IF NOT 
				if (!is_dir($this->temp_auction_path)) {
					mkdir($this->temp_auction_path, 0777);
				}
				//CREATE auction ID FOLDER 
				$auction_id_path = $this->temp_auction_path;
				if (!is_dir($auction_id_path)) {
					mkdir($auction_id_path, 0777);
				}
				$image->move($auction_id_path, $new_name);

				$data =array();
				$data['image'] = $new_name;
				$data['original_image']	= trim($image->getClientOriginalName());
				$data['mimes']	= trim($image->getClientOriginalExtension());
				$data['user_id'] = $user_id;
				$dat = TempMedia::create($data);

				$temp_media_id = $dat->id;
				$imageType='temp';
				$media = $dat;
				$view = view('admin.auctions.imageGallery', compact('media','imageType'))->render();
				$result =array('success' => true,'temp_id'=>$temp_media_id,'view'=>$view);	
		   		return Response::json($result, 200);
			}else{
				$result =array('success' => false,'message'=>'Something, went wrong');	
		   		return Response::json($result, 200);
			}
		}
	}

	public function tempSaveFeatureMedia(CreateTempLotsFeatureMediaRequest $request){
		$result = [];
		$result['success'] = false;
    	$result['message'] = 'Invalid Request';
		if($request->ajax()){
			$image = $request->file('upload_feature_file');
			
			if(!empty($image)){
				$new_name = rand() . '_auction_' . $image->getClientOriginalName();
				$user_id = $request->user_id;

				//CREATE auction FOLDER IF NOT 
				if (!is_dir($this->temp_auction_path)) {
					mkdir($this->temp_auction_path, 0777);
				}
				//CREATE auction ID FOLDER 
				$auction_id_path = $this->temp_auction_path;
				
				if (!is_dir($auction_id_path)) {
					mkdir($auction_id_path, 0777);
				}
				$image->move($auction_id_path, $new_name);
				
				$data =array();
				$data['image'] = $new_name;
				$data['original_image'] = $image->getClientOriginalName();
				$data['mimes'] = trim($image->getClientOriginalExtension());
				$data['user_id'] = $user_id;
				$dat = TempMedia::create($data);

				/*$image_file = $request->upload_feature_file;
				list($type, $image_file) = explode(';', $image_file);
				list(, $image_file)      = explode(',', $image_file);
				$image_file = base64_decode($image_file);
				$new_name= time().'_auction_'.rand(100,999).'.png';

				$user_id = $request->user_id;

				//CREATE auction FOLDER IF NOT 
				if (!is_dir($this->temp_auction_path)) {
					mkdir($this->temp_auction_path, 0777);
				}
				//CREATE auction ID FOLDER 
				$auction_id_path = $this->temp_auction_path;
				if (!is_dir($auction_id_path)) {
					mkdir($auction_id_path, 0777);
				}
				file_put_contents($auction_id_path.'/'.$new_name, $image_file);*/


				$temp_media_id = $dat->id;
				//$result =array('success' => true,'temp_id'=>$temp_media_id);
				$result['success'] = true;
				$result['message'] = 'Successfully save Feature Media.';
				$result['temp_id'] = $temp_media_id;
		   	}
		}
		return Response::json($result, 200);
	}

	public function fetchAuctionImages(FetchAuctionMediaRequest $request){
		$data = [];
    	$data['success'] = false;
    	$data['message'] = 'Invalid Request';
		if($request->ajax()){
			$fileList = array();
			$auction_id = trim($request->auction_id);
			$request_data = $request->all();
			if(trim($request_data['request']) == 'fetch'){
				$medias = Media::where('auction_id',$auction_id)->get();
				if(count($medias) > 0){
					foreach ($medias as $key => $media) {
						$file_url = $media->image_url;
						$file_path = $this->auction_path.'/'.$auction_id.'/'.$media->image;
						//$file_path = $media->image_url;
						$size = filesize($file_path);
		                $fileList[] = ['name'=>$media->image, 'size'=>$size, 'path'=>$file_url,'id'=>$media->id];
					}
				}
				return Response::json($fileList, 200);
			}elseif (trim($request_data['request']) == 'temp_fetch') {
				//fetch all Ids
				$auction_id = trim($request->auction_id);
				if(!empty($auction_id)){
					//Check is feature image or gallery Image
					if(isset($request_data['feature_image']) && $request_data['feature_image'] != null && $request_data['feature_image'] == 1){

						$tempmedia = TempMedia::where('id', $auction_id)->first();
						
						if($tempmedia){
							$data['success'] = true;
							$data['message'] = 'Successfully fetch Feature Media.';
							$data['src'] = $tempmedia->image_url;
						}
			    		

					}else{
						$tempIdArray = explode(",",$auction_id);
						$tempmedia = TempMedia::whereIn('id', $tempIdArray)->orderBy('position')->get();
						
			    		$data['success'] = true;
						$data['message'] = 'Successfully fetch Media.';
						$data['view'] = view('admin.auctions.tempImageGallery', compact('tempmedia'))->render();
					}
				}
				
				return Response::json($data, 200);
			}
			//return Response::json($fileList, 200);
		}
	}

	public function remove_auction_image(RemoveAuctionMediaRequest $request){
		$data = [];
    	$data['success'] = false;
    	$data['message'] = 'Invalid Request';
		if($request->ajax()){
			$mediaId = trim($request->mediaId);
			if(trim($request->image_type) == 'original'){

				$media = Media::where('id',$mediaId)->first();
				if(!empty($media)){
					$auction_id = $media->auction_id;
					$destinationPath = $this->auction_path.'/'.$auction_id.'/'.$media->image;
					chmod($destinationPath, 0777);
			        @unlink($destinationPath);
			        Media::where('id',$mediaId)->delete();

			        $data['success'] = true;
    				$data['message'] = 'Media Delete successfully';
				}
			}elseif (trim($request->image_type) == 'temp') {
				$media = TempMedia::where('id',$mediaId)->first();
				
				if(!empty($media)){
					$destinationPath = $this->temp_auction_path.'/'. $media->image;
					chmod($destinationPath, 0777);
			        @unlink($destinationPath);
			        TempMedia::where('id',$mediaId)->delete();

			        $data['success'] = true;
    				$data['message'] = 'Media Delete successfully';
				}
				
			}
		}
		return Response::json($data, 200);
	}


	//Downlad Image
	public function downloadFeatureImage($auction_id,$media_id = ''){
		if(!empty($auction_id)){
			if(!empty($media_id)){
				$media = Media::where('id',$media_id)->firstOrFail();
				if(!empty($media)){
					$path = $this->auction_path.'/'.$auction_id.'/'.$media->image;
					$headers = ['Content-Type' => $media->mimes];
					$downloadFilename = $media->original_image;
					return Response::download($path, $downloadFilename, $headers);
				}	
			}else{
				$auction = Auction::where('id',$auction_id)->firstOrFail();
				if(!empty($auction)){
					//$path = $category->image_url;
					$path = $this->auction_path.'/'.$auction_id.'/'.$auction->feature_image;
					$headers = ['Content-Type' => $auction->mimes];
					$downloadFilename = $auction->original_feature_image;
					return Response::download($path, $downloadFilename, $headers);
				}
			}

		}
	}


	//delete Image
	public function deleteAuctionImage($auction_id){
		$data = [];
    	$data['success'] = false;
    	$data['message'] = 'Invalid Request';
		if($auction_id){
			$main  = Auction::where('id',$auction_id)->firstOrFail();
			if(!empty($main)){
				$auction = Auction::find($auction_id);
				$auction->feature_image='';
				$auction->original_feature_image='';
				$auction->mimes='';
				$auction->save();

				//unlink media
				$path = $this->auction_path.'/'.$auction_id.'/'.$main->feature_image;
				@unlink($path);

				$data['success'] = true;
				$data['message'] = 'Successfully Lot Image Delete.';
				

			}else{
				$data['message'] = 'There is no Lot found.';
			}
		}
		return Response::json($data, 200);
	}

	//Check Temp Image Exist then delete it
	public function checkTempMedia(){
		$user_id = auth::user()->id;
		$tempMedia = TempMedia::where('user_id',$user_id)->get();
		if(!empty($tempMedia) && count($tempMedia) > 0){
			//Delete Temp Media
			TempMedia::where('user_id',$user_id)->delete();
		} 
	}

}

?>