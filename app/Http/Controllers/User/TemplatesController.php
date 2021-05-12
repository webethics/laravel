<?php 
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTemplateRequest;
use App\Http\Requests\UpdateTemplateRequest;
use Auth;
use Config;
use App\Models\Article;
use App\Models\ArabicArticle;
use App\Models\Download;
use Response;
use Session;
use Illuminate\Support\Str;
class TemplatesController extends Controller
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
	
	
	public function getSingleTemplate($templateId){
		$this->setTableName();
		$templatedata = $this->table::where('type','template')->where('id',$templateId)->first();
		$view = view("frontend.pages.templates.singlerowdata",['template'=> $templatedata])->render();
		return response()->json(['success' => true, 'html'=>$view]);
	
	}
	
	
	public function index()
    {
		$this->setTableName();
		$number_of_records =$this->per_page;
		$templates = $this->table::where('type','template')->where('status',1)->orderBy('position_order','ASC')->paginate($number_of_records);
		$total_templates = $this->table::where('type','template')->where('status',1)->count();
		return view('frontend.pages.templates.index',compact('templates','total_templates'));
    }
	
	public function searchTemplate(Request $request){
		$this->setTableName();
		$query = $request->input('string');
		$templates = $this->table::where('type','template')->where('title', 'LIKE', '%' . $query . '%')->where('status',1)->orderBy('position_order','ASC')->get();
		$view = view("frontend.pages.templates.searchdata",['templates'=> $templates])->render();
		return response()->json(['success' => true, 'html'=>$view]);
		//return view('frontend.pages.templates.index',compact('templates'));
	}
	public function updatePreviewCount(Request $request){
		$this->setTableName();
		if($request->input('infoid')){
			$infoid = $request->input('infoid');
			$templatedata = $this->table::where('type','template')->where('id',$infoid)->first();
			$template = $this->table::where('type','template')->where('id',$infoid);
			$total_count = $templatedata->total_viewed;
			$updated_count = $total_count+1;
			$dataInsert['total_viewed'] = $updated_count;
			echo $update = $template->update($dataInsert);

		}
		
	}
	public function template_details($id = false,$lang = false){
		
		if($lang == 'ar'){
			$this->table = new ArabicArticle();
		}else{
			$this->table = new Article();
		}
	
		
		$data = array();
		$template = $this->table::where('type','template')->where('id',$id)->first();
		$featured_templates = $this->table::where('type','template')->where('status',1)->where('is_featured',1)->paginate(3);
		return view('frontend.pages.templates.single-templates-test',compact('template','featured_templates'));
    }
	public function template_details_test($id = false,$lang = false){
		
		if($lang == 'ar'){
			$this->table = new ArabicArticle();
		}else{
			$this->table = new Article();
		}
	
		
		$data = array();
		$template = $this->table::where('type','template')->where('id',$id)->first();
		$featured_templates = $this->table::where('type','template')->where('status',1)->where('is_featured',1)->paginate(3);
		return view('frontend.pages.templates.single-templates-test',compact('template','featured_templates'));
    }
	
	public function updateDpdfCount(Request $request){
		$this->setTableName();
		if($request->input('infoid')){
			$infoid = $request->input('infoid');
			$templatedata = $this->table::where('type','template')->where('id',$infoid)->first();
			$template = $this->table::where('type','template')->where('id',$infoid);
			$total_count = $templatedata->total_dwlnd_pdf;
			$updated_count = $total_count+1;
			$dataInsert['total_dwlnd_pdf'] = $updated_count;
			$this->updateDownloadStatus($request->user_id, $request->infoid);
			echo $update = $template->update($dataInsert);

		}
			
	}

	public function updateDepdfCount(Request $request){
		$this->setTableName();
		if($request->input('infoid')){
			$infoid = $request->input('infoid');
			$templatedata = $this->table::where('type','template')->where('id',$infoid)->first();
			$template = $this->table::where('type','template')->where('id',$infoid);
			
			$total_count = $templatedata->total_dwlnd_editable;
			$updated_count = $total_count+1;
			$dataInsert['total_dwlnd_editable'] = $updated_count;
			$this->updateDownloadStatus($request->user_id, $request->infoid);
			echo $update = $template->update($dataInsert);
		}
		
	}
	public function getSlugInfo(Request $request){
		$this->setTableName();
		$slug = $request->input('slug');
		$formdata = $this->table::where('type','template')->where('slug',$slug)->select('id')->first();
		return $formdata->id;
	
	}
	
	
	public function updatesharecount(Request $request){
		$this->setTableName();
		if($request->input('infoid')){
			$infoid =$request->input('infoid');
			$infographicdata = $this->table::where('type','template')->where('id',$infoid)->first();
			$infographic = $this->table::where('type','template')->where('id',$infoid);
			
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
		$data['type'] = 'template';
		$data['language'] = Session::get('language') ? Session::get('language') : 'en';
		$dat = Download::create($data);
	}
}
?>