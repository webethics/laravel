<?php 
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateFormRequest;
use App\Http\Requests\UpdateFormRequest;
use Auth;
use Config;
use Session;
use App\Models\Download;
use App\Models\Article;
use App\Models\ArabicArticle;
use Response;
use Illuminate\Support\Str;

class FormsController extends Controller
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
	
	public function getSlugInfo(Request $request){
		$this->setTableName();
		$slug = $request->input('slug');
		$formdata = $this->table::where('type','form')->where('slug',$slug)->select('id')->first();
		
		return $formdata->id;
	
	}
	public function form_details($id = false,$lang = false){
		if($lang == 'ar'){
			$this->table = new ArabicArticle();
		}else{
			$this->table = new Article();
		}
		
		$data = array();
		$form = $this->table::where('type','form')->where('id',$id)->first();
		$featured_forms = $this->table::where('type','form')->where('status',1)->where('is_featured',1)->paginate(3);
		return view('frontend.pages.forms.single-forms-test',compact('form','featured_forms'));
    }
	public function form_details_test($id = false,$lang = false){
		if($lang == 'ar'){
			$this->table = new ArabicArticle();
		}else{
			$this->table = new Article();
		}
		
		$data = array();
		$form = $this->table::where('type','form')->where('id',$id)->first();
		$featured_forms = $this->table::where('type','form')->where('status',1)->where('is_featured',1)->paginate(3);
		return view('frontend.pages.forms.single-forms-test',compact('form','featured_forms'));
    }
	
	public function index()
    {
		$this->setTableName();
		$number_of_records =$this->per_page;
		$forms = $this->table::where('type','form')->where('status',1)->orderBy('position_order','ASC')->paginate($number_of_records);
		$total_forms = $this->table::where('type','form')->where('status',1)->count();
		return view('frontend.pages.forms.index',compact('forms','total_forms'));
    }
	
	public function getSingleForm($formId){
		
		$this->setTableName();
		$formdata = $this->table::where('type','form')->where('id',$formId)->first();
		$view = view("frontend.pages.forms.singlerowdata",['form'=> $formdata])->render();
		return response()->json(['success' => true, 'html'=>$view]);
	
	}
	
	public function searchTemplate(Request $request){
		$this->setTableName();
		$query = $request->input('string');
		$forms = $this->table::where('type','form')->where('title', 'LIKE', '%' . $query . '%')->where('status',1)->orderBy('position_order','ASC')->get();
		$view = view("frontend.pages.forms.searchdata",['forms'=> $forms])->render();
		return response()->json(['success' => true, 'html'=>$view]);
		//return view('frontend.pages.templates.index',compact('templates'));
	}
	
	public function updatePreviewCount(Request $request){
		$this->setTableName();
		if($request->input('infoid')){
			$infoid = $request->input('infoid');
			$formdata = $this->table::where('type','form')->where('id',$infoid)->first();
			$form = $this->table::where('type','form')->where('id',$infoid);
			$total_count = $formdata->total_viewed;
			$updated_count = $total_count+1;
			$dataInsert['total_viewed'] = $updated_count;
			echo $update = $form->update($dataInsert);

		}
		
	}

	public function updateDpdfCount(Request $request){
		$this->setTableName();
		if($request->input('infoid')){
			$infoid = $request->input('infoid');
			$formdata = $this->table::where('type','form')->where('id',$infoid)->first();
			$form = $this->table::where('type','form')->where('id',$infoid);
			$total_count = $formdata->total_dwlnd_pdf;
			$updated_count = $total_count+1;
			$dataInsert['total_dwlnd_pdf'] = $updated_count;
			$this->updateDownloadStatus($request->user_id, $request->infoid);
			echo $update = $form->update($dataInsert);

		}
			
	}

	public function updateDepdfCount(Request $request){
		$this->setTableName();
		if($request->input('infoid')){
			$infoid = $request->input('infoid');
			$formdata = $this->table::where('type','form')->where('id',$infoid)->first();
			$form = $this->table::where('type','form')->where('id',$infoid);
			$total_count = $formdata->total_dwlnd_editable;
			$updated_count = $total_count+1;
			$dataInsert['total_dwlnd_editable'] = $updated_count;
			$this->updateDownloadStatus($request->user_id, $request->infoid);
			echo $update = $form->update($dataInsert);
		}
		
	}
	
	function updateDownloadStatus($user_id,$article_id){
		$this->setTableName();
		$data['user_id'] = $user_id;
		$data['article_id'] =  $article_id;
		$data['language'] = Session::get('language') ? Session::get('language') : 'en';
		$data['type'] = 'form';
		$dat = Download::create($data);
	}
	
	public function updatesharecount(Request $request){
		$this->setTableName();
		if($request->input('infoid')){
			$infoid =$request->input('infoid');
			$infographicdata = $this->table::where('type','form')->where('id',$infoid)->first();
			$infographic = $this->table::where('type','form')->where('id',$infoid);
			
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
		
}
?>