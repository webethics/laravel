<?php 
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateInfographicRequest;
use App\Http\Requests\UpdateInfographicRequest;
use Auth;
use Config;
use App\Models\Article;
use App\Models\ArabicArticle;
use App\Models\Download;
use App\Models\Subscription;
use Session;
use Illuminate\Support\Str;
use Response;

class InfographicsController extends Controller
{
	protected $featured_image_path;
	protected $pdf_image_path;
	protected $editable_file_path;
	protected $slideshow_images_path;
	protected $per_page;
	public function __construct()
    {
	   
         $this->per_page = Config::get('constant.posts_per_page');;
    }
	
	public function setTableName(){
		
		if(Session::get('language') == 'ar'){
			$this->table = new ArabicArticle();
		}else{
			$this->table = new Article();
		}
		
	}
	
	
	public function index(Request $request)
    {
		$this->setTableName();
		$pagenumber = $request->page;
		$number_of_records =$this->per_page;
		$infographics = $this->table::where('type','infographic')->where('status',1)->orderBy('position_order','ASC')->paginate($number_of_records);
		$total_infographics = $this->table::where('type','infographic')->where('status',1)->count();
		return view('frontend.pages.infographics.index',compact('infographics','total_infographics','pagenumber'));
    }	
	
	public function getSingleForm($infoId){
		$this->setTableName();
		$formdata = $this->table::where('type','infographic')->where('id',$infoId)->first();
		$view = view("frontend.pages.infographics.singlerowdata",['infographic'=> $formdata])->render();
		return response()->json(['success' => true, 'html'=>$view]);
	
	}
	public function getSlugInfo(Request $request){
		$this->setTableName();
		$slug = $request->input('slug');
		$formdata = $this->table::where('type','infographic')->where('slug',$slug)->select('id')->first();
		return $formdata->id;
	
	}
	public function infographic_details($id,$lang){
		if($lang == 'ar'){
			$this->table = new ArabicArticle();
		}else{
			$this->table = new Article();
		}
		$data = array();
		$infographic = $this->table::where('type','infographic')->where('id',$id)->first();
		$featured_infographic = $this->table::where('type','infographic')->where('status',1)->where('is_featured',1)->paginate(3);
		
		return view('frontend.pages.infographics.single-infographics-test',compact('infographic','featured_infographic'));
		
    }
	
	public function infographic_details_test($id,$lang){
		if($lang == 'ar'){
			$this->table = new ArabicArticle();
		}else{
			$this->table = new Article();
		}
		$data = array();
		$infographic = $this->table::where('type','infographic')->where('id',$id)->first();
		$featured_infographic = $this->table::where('type','infographic')->where('status',1)->where('is_featured',1)->paginate(3);
		
		return view('frontend.pages.infographics.single-infographics-test',compact('infographic','featured_infographic'));
		
    }
	
	
	public function searchTemplate(Request $request){
		$this->setTableName();
		$query = $request->input('string');
		$infographics = $this->table::where('type','infographic')->where('title', 'LIKE', '%' . $query . '%')->where('status',1)->orderBy('position_order','ASC')->get();
		$view = view("frontend.pages.infographics.searchdata",['infographics'=> $infographics])->render();
		return response()->json(['success' => true, 'html'=>$view]);
		//return view('frontend.pages.templates.index',compact('templates'));
	}
	
	
	public function updatePreviewCount(Request $request){
		$this->setTableName();
		if($request->input('infoid')){
			$infoid = $request->input('infoid');
			$infographicdata = $this->table::where('type','infographic')->where('id',$infoid)->first();
			$infographic = $this->table::where('type','infographic')->where('id',$infoid);
			$total_count = $infographicdata->total_viewed;
			$updated_count = $total_count+1;
			$dataInsert['total_viewed'] = $updated_count;
			echo $update = $infographic->update($dataInsert);

		}
		
	}

	public function updateDpdfCount(Request $request){
		$this->setTableName();
		if($request->input('infoid')){
			$infoid = $request->input('infoid');
			$infographicdata = $this->table::where('type','infographic')->where('id',$infoid)->first();
			$infographic = $this->table::where('type','infographic')->where('id',$infoid);
			$total_count = $infographicdata->total_dwlnd_pdf;
			$updated_count = $total_count+1;
			$dataInsert['total_dwlnd_pdf'] = $updated_count;
			$this->updateDownloadStatus($request->user_id, $request->infoid);
			echo $update = $infographic->update($dataInsert);

		}
			
	}

	public function updateDepdfCount(Request $request){
		$this->setTableName();
		if($request->input('infoid')){
			$infoid = $request->input('infoid');
			$infographicdata = $this->table::where('type','infographic')->where('id',$infoid)->first();
			$infographic = $this->table::where('type','infographic')->where('id',$infoid);
			
			$total_count = $infographicdata->total_dwlnd_editable;
			$updated_count = $total_count+1;
			$dataInsert['total_dwlnd_editable'] = $updated_count;
			$this->updateDownloadStatus($request->user_id, $request->infoid);
			echo $update = $infographic->update($dataInsert);
		}
		
	}
	
	public function updatesharecount(Request $request){
		$this->setTableName();
		if($request->input('infoid')){
			$infoid =$request->input('infoid');
			$infographicdata = $this->table::where('type','infographic')->where('id',$infoid)->first();
			$infographic = $this->table::where('type','infographic')->where('id',$infoid);
			
			if($infographicdata->views != ''){
			$total_count = $infographicdata->views;
			$updated_count = $total_count+1;
			}else{
				$updated_count = 1;
			}
			$dataInsert['views'] = $updated_count;
			echo $update = $infographic->update($dataInsert);
		}
	}
		
		
	function updateDownloadStatus($user_id,$article_id){
		$this->setTableName();
		$data['user_id'] = $user_id;
		$data['article_id'] =  $article_id;
		$data['language'] = Session::get('language') ? Session::get('language') : 'en';
		$data['type'] = 'infographic';
		$dat = Download::create($data);
	}
	
}
?>