<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTemplateRequest;
use App\Http\Requests\SortTemplateRequest;
use App\Http\Requests\UpdateTemplateRequest;
use Auth;
use League\Csv\Writer;
use Config;
use App\Models\Article;
use App\Models\ArabicArticle;
use Response;
//use App\Category;
use App\Models\Category;
use Session;
// use \Imagick;
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
	    // $this->featured_image_path = public_path('/uploads/templates/featured_image/');
	    $this->featured_image_path = public_path('/uploads/templates/');
        $this->pdf_image_path = public_path('/uploads/templates/');
        $this->editable_file_path = public_path('/uploads/templates/editable/');
        $this->slideshow_images_path = public_path('/uploads/templates/slideshow/');
        $this->per_page = Config::get('constant.per_page');
    }
	

	
	public function listtemplates(Request $request)
    {	
		$language  = 'en';
		  $templates_data = $this->template_search($request,$pagination=true);
		
		if($templates_data['success']){
			$listTemplates = $templates_data['templates'];
			$page_number =  $templates_data['current_page'];
			$number_of_records =  $templates_data['number_of_records'];
			if(empty($page_number))
				$page_number = 1;
			
			if(!is_object($listTemplates)) return $listTemplates;
			if ($request->ajax()) {
				return view('admin.templates.templatePagination', compact('listTemplates','page_number','number_of_records','language'));
			}
			return view('admin.templates.index',compact('listTemplates','page_number','roles','number_of_records','language'));	
		}else{
			return $customers_data['message'];
		}
		
		
	}
	
	public function template_search($request,$pagination)
	{
		
		$page_number = $request->page;
		$number_of_records = $request->per_page?$request->per_page:25;
		$title = $request->title;
		
		
		$result = Article::where('type','template');
		
		// check title 
		if(isset($title) && !empty($title)){
			$title_s = '%' . $title . '%';
			$result->where('title','LIKE',$title_s);
		}
		
		if($pagination == true){
			$templates = $result->orderByRaw(
												 "CASE WHEN position_order > 0 THEN position_order ELSE id END ASC"
											)->paginate($number_of_records);
		}else{
			$templates = $result->orderByRaw(
												 "CASE WHEN position_order > 0 THEN position_order ELSE id END ASC"
											)->orderBy('id', 'ASC')->get();
		}
		
		
		$data = array();
		$data['success'] = true;
		$data['templates'] = $templates;
		$data['number_of_records'] = $number_of_records;
		$data['current_page'] = $page_number;
		return $data;
	}
	public function listtemplates_arabic(Request $request)
    {	
		$language  = 'ar';
		  $templates_data = $this->template_search_arabic($request,$pagination=true);
		
		if($templates_data['success']){
			$listTemplates = $templates_data['templates'];
			$page_number =  $templates_data['current_page'];
			$number_of_records =  $templates_data['number_of_records'];
			if(empty($page_number))
				$page_number = 1;
			
			if(!is_object($listTemplates)) return $listTemplates;
			if ($request->ajax()) {
				return view('admin.templates.templatePagination-arabic', compact('listTemplates','page_number','number_of_records','language'));
			}
			return view('admin.templates.index-arabic',compact('listTemplates','page_number','roles','number_of_records','language'));	
		}else{
			return $customers_data['message'];
		}
		
		
	}
	
	public function template_search_arabic($request,$pagination)
	{
		
		$page_number = $request->page;
		$number_of_records = $request->per_page?$request->per_page:25;
		$title = $request->title;
		
		
		$result = ArabicArticle::where('type','template');
		
		// check title 
		if(isset($title) && !empty($title)){
			$title_s = '%' . $title . '%';
			$result->where('title','LIKE',$title_s);
		}
		
		if($pagination == true){
			$templates = $result->orderByRaw(
												 "CASE WHEN position_order > 0 THEN position_order ELSE id END ASC"
											)->paginate($number_of_records);
		}else{
			$templates = $result->orderByRaw(
												 "CASE WHEN position_order > 0 THEN position_order ELSE id END ASC"
											)->orderBy('id', 'ASC')->get();
		}
		
		
		$data = array();
		$data['success'] = true;
		$data['templates'] = $templates;
		$data['number_of_records'] = $number_of_records;
		$data['current_page'] = $page_number;
		return $data;
	}
	
	public function template_edit($template_id,$lang)
    {
		if($lang == 'ar'){
			$template = ArabicArticle::where('id',$template_id)->where('type','template')->first();
			$categories = Category::where('category_name','templates')->get();
			/* $roles = Role::all(); */
			if($template){
				return view('admin.templates.templateEdit' , compact('template','categories','lang'));
				$success = true;
			}else{
				$view = '';
				$success = false;
			}
		}else{
			$lang = 'en';
			$template = Article::where('id',$template_id)->where('type','template')->first();
			$categories = Category::where('category_name','templates')->get();
			/* $roles = Role::all(); */
			if($template){
				return view('admin.templates.templateEdit' , compact('template','categories','lang'));
				$success = true;
			}else{
				$view = '';
				$success = false;
			}
		}
		
	}
	
	public function template_create()
    {
		$categories = Category::where('category_name','templates')->get();
		return view('admin.templates.templateCreate',compact('categories'));
		
	}
	public function arabic_template_create()
    {
		$categories = Category::where('category_name','templates')->get();
		return view('admin.templates.arabicTemplateCreate',compact('categories'));
		
	}
	
	public function update_template(UpdateTemplateRequest $request)
    {
		$lang = $request->lang;
		if($lang == 'ar'){
			$table = new ArabicArticle();
		}else{
			$table = new Article();
		}
		ini_set("memory_limit", "256M");
		$title = $request->input('title');
	    $slug = $request->input('slug');
	    $description = $request->input('description');
	    $article_id = $request->input('article_id');
		$excerpt = $request->excerpt;
		$is_featured = $request->is_featured;
		$is_protected = $request->is_protected;
		$status = $request->status;
		$category = $request->category;
		$author = $request->author;
		$meta_title = $request->meta_title;
		$meta_description = $request->meta_description;
		
	    // update email template
	    $data = array('title'=>$title,'slug'=>$slug,'description'=>$description,'excerpt'=>$excerpt,'is_featured'=>$is_featured,'is_protected'=>$is_protected,'status'=>$status,'category'=>$category,'author'=>$author,'meta_title'=>$meta_title,'meta_description'=>$meta_description);
		
		if($request->file('image')){
			$featured_image = $request->file('image');
			if (!is_dir($this->featured_image_path)) {
				mkdir($this->featured_image_path, 0777);
			}
			
			$randomString = sha1(date('YmdHis') . Str::random(30));
			$save_name = $randomString . '.' . $featured_image->getClientOriginalExtension();
			$data['featured_image'] = $save_name;
			//Move Uploaded File
			$featured_image->move($this->featured_image_path, $save_name);
		}
		if($request->file('pdf_image')){
			$pdf_image = $request->file('pdf_image');
			if (!is_dir($this->pdf_image_path)) {
				mkdir($this->pdf_image_path, 0777);
			}
			
			$randomString = sha1(date('YmdHis') . Str::random(30));
			$save_name = $randomString . '.' . $pdf_image->getClientOriginalExtension();
			$data['files'] = $save_name;
			//Move Uploaded File
			$pdf_image->move($this->pdf_image_path, $save_name);
		}
		
		if($request->file('editable_file')){
			$editable_file = $request->file('editable_file');
			if (!is_dir($this->editable_file_path)) {
				mkdir($this->editable_file_path, 0777);
			}
			
			$randomString = sha1(date('YmdHis') . Str::random(30));
			$save_name = $randomString . '.' . $editable_file->getClientOriginalExtension();
			$data['editableFile'] = $save_name;
			//Move Uploaded File
			$editable_file->move($this->editable_file_path, $save_name);
		}
		
		$allimg = array();
		if($request->file('preview_images')){
			$preview_images = $request->file('preview_images');
			if (!is_dir($this->slideshow_images_path)) {
				mkdir($this->slideshow_images_path, 0777);
			}
			
			foreach($preview_images as $key=>$images){
				$randomString = sha1(date('YmdHis') . Str::random(30));
				$save_name = $randomString . '.' . $images->getClientOriginalExtension();
				$allimg[] = $save_name;
				//Move Uploaded File
				$images->move($this->slideshow_images_path, $save_name);
			}
			$data['slideshow'] = implode(',',$allimg);
		}
		
		// die("REACH");
		$article_update  = $table::where('id', '=', $article_id);
	//	echo '<pre>';print_r($data);die;
		$article_update->update($data);
		
		$template = $table::where('id',$article_id)->where('type','template')->first();
		$pdfile = $template->files;
		$pdfile_url = url('/uploads/templates/'.$pdfile);
		
		$path_info = pathinfo(public_path($pdfile));
		
		$dataInsert1['preview_imgs'] = 0;
		
		/* if(!empty($pdfile) && $path_info['extension'] == "pdf"){
			$pdfdata = explode('.net',$pdfile_url);
			
			$im = new \Imagick();
			
			$im->setResolution(300,300);
			$im->pingImage("/var/www/html/splashpro/public".$pdfdata[1]);
			$count = $im->getNumberImages();
			
			$dataInsert1['preview_imgs'] = $count;
			for($i=0;$i<$count;$i++){
				$im->readimage("/var/www/html/public".$pdfdata[1]."[".$i."]"); 
				$im->setImageColorspace(255); 
				$im->setCompression(\Imagick::COMPRESSION_JPEG); 
				$im->setCompressionQuality(60); 
				$im->setImageBackgroundColor('#ffffff');
				$im->setImageAlphaChannel(\Imagick::ALPHACHANNEL_REMOVE);
				//$im->mergeImageLayers(Imagick::LAYERMETHOD_FLATTEN);		
				$im->setImageFormat('jpeg'); 
				$im->writeImage('/var/www/html/public/uploads/templates/output'.$article_id.$i.'.jpg'); 
				$im->clear(); 
				$im->destroy(); 
			}
			$im->readimage("/var/www/html/public".$pdfdata[1]."[0]"); 
			$im->setImageColorspace(255); 
			$im->setCompression(\Imagick::COMPRESSION_JPEG); 
			$im->setCompressionQuality(60); 
			$im->setImageBackgroundColor('#ffffff');
			$im->setImageAlphaChannel(\Imagick::ALPHACHANNEL_REMOVE);
			//$im->mergeImageLayers(Imagick::LAYERMETHOD_FLATTEN);		
			$im->setImageFormat('jpeg'); 
			$im->writeImage('/var/www/html/public/uploads/templates/featured'.$article_id.'1.jpg'); 
			$im->clear(); 
			$im->destroy(); 
		} */ 
		$article_update->update($dataInsert1);
		Session::flash('success', 'Article has been Updated.');
		return redirect('admin/templates/edit/'.$article_id.'/'.$lang); 
		
	}
	
	public function create_template(CreateTemplateRequest $request){
		
		//echo '<pre>';print_r($request->all());die;
		
		if($request->langauge == 2){
			if($this->bothTemplate($request) == true){
				return redirect('admin/listtemplates');
			}
		}
		if($request->langauge == 1){
			
			if($this->englishTemplate($request) == true){
				return redirect('admin/listtemplates');
			}
		} 
		if($request->langauge == 3){
			
			if($this->arabic_create_template($request) == true){
				return redirect('admin/listtemplates-arabic');
			}
		} 
		
	}
	public function englishTemplate($request){
		
		ini_set("memory_limit", "256M");
		$response = [];
    	$response['success'] = false;
    	$response['message'] = 'Invalid Request';
		//if($request->ajax()){
		$data =array();
		$data['title']	= $request->title;
		$data['slug'] =  create_slugify($request->title);
		$data['is_featured'] = $request->is_featured;
		$data['is_protected'] = $request->is_protected;
		$data['status'] = $request->status;
		$data['category'] = $request->category;
		$data['author'] = $request->author;
		$data['views'] = 0;
	
		
		$data['featured_image'] = $this->uploadFeaturedImage($request->file('image'));
		$data['files'] = $this->uploadPDFImage($request->file('pdf_image'));
		$data['editableFile'] = $this->uploadEditableFile($request->file('editable_file'));
		$data['slideshow'] = $this->uploadPreviewImages($request->file('preview_images'));
		  
		if($request->meta_title){
			$data['meta_title'] = $request->meta_title;
		}else{
			$data['meta_title'] = $data['title'];
		}
			
			
		$data['meta_description'] = $request->meta_description;
		$data['type'] = 'template';
		
		$dat = Article::create($data);
		$article_id = $dat->id;
		$template = Article::where('id',$article_id)->where('type','template')->first();
		$pdfile = $template->files;
		$pdfile_url = url('/uploads/templates/'.$pdfile);
		
		$path_info = pathinfo(public_path($pdfile));
		
		$dataInsert1['preview_imgs'] = 0;//$this->makeImagesFromPDF($pdfile,$path_info,$pdfile_url,$article_id);
		$article_update  = Article::where('id', '=', $article_id);
		$article_update->update($dataInsert1);
		$this->modifyCategorySort($article_id);
		return true;
		
	}
	public function uploadPDFImage($requestFile){
		if($requestFile){
			$pdf_image = $requestFile;
			if (!is_dir($this->pdf_image_path)) {
				mkdir($this->pdf_image_path, 0777);
			}
			
			$randomString = sha1(date('YmdHis') . Str::random(30));
			$save_name = $randomString . '.' . $pdf_image->getClientOriginalExtension();
			
			//Move Uploaded File
			$pdf_image->move($this->pdf_image_path, $save_name);
			return $save_name;
		}
		
	}
	public function uploadFeaturedImage($featured_image){
		if($featured_image){
			if (!is_dir($this->featured_image_path)) {
				mkdir($this->featured_image_path, 0777);
			}
			
			$randomString = sha1(date('YmdHis') . Str::random(30));
			$save_name = $randomString . '.' . $featured_image->getClientOriginalExtension();
			//Move Uploaded File
			$featured_image->move($this->featured_image_path, $save_name);
			
			return $save_name;
		}
		
	}
	public function uploadEditableFile($editable_file){
		if($editable_file){
			
			if (!is_dir($this->editable_file_path)) {
				mkdir($this->editable_file_path, 0777);
			}
			
			$randomString = sha1(date('YmdHis') . Str::random(30));
			$save_name = $randomString . '.' . $editable_file->getClientOriginalExtension();
			//$data['editableFile'] = $save_name;
			//Move Uploaded File
			$editable_file->move($this->editable_file_path, $save_name);
			
			
			return $save_name;
		}
		
	}
	public function uploadPreviewImages($preview_images){
		$allimg = array();
		if($preview_images){
			
			if (!is_dir($this->slideshow_images_path)) {
				mkdir($this->slideshow_images_path, 0777);
			}
			
			foreach($preview_images as $key=>$images){
				$randomString = sha1(date('YmdHis') . Str::random(30));
				$save_name = $randomString . '.' . $images->getClientOriginalExtension();
				$allimg[] = $save_name;
				//Move Uploaded File
				$images->move($this->slideshow_images_path, $save_name);
			}
			 return $allimg;
		}
		
	}
	
	public function makeImagesFromPDF($pdfile,$path_info,$pdfile_url,$article_id){
		if(!empty($pdfile) && $path_info['extension'] == "pdf"){
			$pdfdata = explode('.net',$pdfile_url);
			
			$im = new \Imagick();
			
			$im->setResolution(300,300);
			$im->pingImage("/var/www/html/public".$pdfdata[1]);
			$count = $im->getNumberImages();
			
			$preview_imgs = $count;
			for($i=0;$i<$count;$i++){
				$im->readimage("/var/www/html/public".$pdfdata[1]."[".$i."]"); 
				$im->setImageColorspace(255); 
				$im->setCompression(\Imagick::COMPRESSION_JPEG); 
				$im->setCompressionQuality(60); 
				$im->setImageBackgroundColor('#ffffff');
				$im->setImageAlphaChannel(\Imagick::ALPHACHANNEL_REMOVE);
				//$im->mergeImageLayers(Imagick::LAYERMETHOD_FLATTEN);		
				$im->setImageFormat('jpeg'); 
				$im->writeImage('/var/www/html/public/uploads/templates/output'.$article_id.$i.'.jpg'); 
				$im->clear(); 
				$im->destroy(); 
			}
			$im->readimage("/var/www/html/public".$pdfdata[1]."[0]"); 
			$im->setImageColorspace(255); 
			$im->setCompression(\Imagick::COMPRESSION_JPEG); 
			$im->setCompressionQuality(60); 
			$im->setImageBackgroundColor('#ffffff');
			$im->setImageAlphaChannel(\Imagick::ALPHACHANNEL_REMOVE);
			//$im->mergeImageLayers(Imagick::LAYERMETHOD_FLATTEN);		
			$im->setImageFormat('jpeg'); 
			$im->writeImage('/var/www/html/public/uploads/templates/featured'.$article_id.'1.jpg'); 
			$im->clear(); 
			$im->destroy(); 
			return $preview_imgs;
		}
	}
	
	public function bothTemplate($request){
		
		ini_set("memory_limit", "256M");
		$response = [];
    	$response['success'] = false;
    	$response['message'] = 'Invalid Request';
		//if($request->ajax()){
		$data =array();
		$data['title']	= $request->title;
		$data['slug'] =  create_slugify($request->title);
		$data['is_featured'] = $request->is_featured;
		$data['is_protected'] = $request->is_protected;
		$data['status'] = $request->status;
		$data['category'] = $request->category;
		$data['author'] = $request->author;
		$data['views'] = 0;
	
		$data['featured_image'] = $this->uploadFeaturedImage($request->file('image'));
		$data['files'] = $this->uploadPDFImage($request->file('pdf_image'));
		$data['editableFile'] = $this->uploadEditableFile($request->file('editable_file'));
		$data['slideshow'] = $this->uploadPreviewImages($request->file('preview_images'));
		
		if($request->meta_title){
			$data['meta_title'] = $request->meta_title;
		}else{
			$data['meta_title'] = $data['title'];
		}
			
			
		$data['meta_description'] = $request->meta_description;
		$data['type'] = 'template';
		
		$dat = Article::create($data);
		$article_id = $dat->id;
		$template = Article::where('id',$article_id)->where('type','template')->first();
		$pdfile = $template->files;
		$pdfile_url = url('/uploads/templates/'.$pdfile);
		
		$path_info = pathinfo(public_path($pdfile));
		
		$dataInsert1['preview_imgs'] = NULL; //$this->makeImagesFromPDF($pdfile,$path_info,$pdfile_url,$article_id);
		
		$article_update  = Article::where('id', '=', $article_id);
		$article_update->update($dataInsert1);
		$this->modifyCategorySort($article_id);
		
	
		$arabic_data =array();
		$arabic_data['title']	= $request->arabic_title;
		$arabic_data['slug'] =  $this->arabic_slug($request->arabic_title);
		$arabic_data['is_featured'] = $request->arabic_is_featured;
		$arabic_data['is_protected'] = $request->arabic_is_protected;
		$arabic_data['status'] = $request->arabic_status;
		$arabic_data['category'] = $request->arabic_category;
		$arabic_data['author'] = $request->arabic_author;
		$arabic_data['views'] = 0;
	
		$arabic_data['featured_image'] = $this->uploadFeaturedImage($request->file('arabic_image'));
		$arabic_data['files'] = $this->uploadPDFImage($request->file('arabic_pdf_image'));
		$arabic_data['editableFile'] = $this->uploadEditableFile($request->file('arabic_editable_file'));
		$arabic_data['slideshow'] = $this->uploadPreviewImages($request->file('arabic_preview_images'));
		
		if($request->meta_title){
			$arabic_data['meta_title'] = $request->arabic_meta_title;
		}else{
			$arabic_data['meta_title'] = $arabic_data['title'];
		}
			
			
		$arabic_data['meta_description'] = $request->arabic_meta_description;
		$arabic_data['type'] = 'template';
		
		$arabic_dat = ArabicArticle::create($arabic_data);
		$arabic_article_id = $arabic_dat->id;
		$template = ArabicArticle::where('id',$arabic_article_id)->where('type','template')->first();
		$arabic_pdfile = $template->files;
		$arabic_pdfile_url = url('/uploads/templates/'.$arabic_pdfile);
		
		$arabic_path_info = pathinfo(public_path($arabic_pdfile));
		
		$dataInsert2['preview_imgs'] = NULL; //$this->makeImagesFromPDF($arabic_pdfile,$arabic_path_info,$arabic_pdfile_url,$arabic_article_id);
		
		$arabic_article_update  = ArabicArticle::where('id', '=', $arabic_article_id);
		
		$arabic_article_update->update($dataInsert2);
		$this->modifyArabicCategorySort($arabic_article_id);
		
		
		return true;
		
	}
	
	public function arabic_create_template(CreateTemplateRequest $request){
		ini_set("memory_limit", "256M");
	
		$arabic_data =array();
		$arabic_data['title']	= $request->arabic_title;
		$arabic_data['slug'] =   $this->arabic_slug($request->arabic_title);
		$arabic_data['is_featured'] = $request->arabic_is_featured;
		$arabic_data['is_protected'] = $request->arabic_is_protected;
		$arabic_data['status'] = $request->arabic_status;
		$arabic_data['category'] = $request->arabic_category;
		$arabic_data['author'] = $request->arabic_author;
		$arabic_data['views'] = 0;
	
		$arabic_data['featured_image'] = $this->uploadFeaturedImage($request->file('arabic_image'));
		$arabic_data['files'] = $this->uploadPDFImage($request->file('arabic_pdf_image'));
		$arabic_data['editableFile'] = $this->uploadEditableFile($request->file('arabic_editable_file'));
		$arabic_data['slideshow'] = $this->uploadPreviewImages($request->file('arabic_preview_images'));
		
		if($request->meta_title){
			$arabic_data['meta_title'] = $request->arabic_meta_title;
		}else{
			$arabic_data['meta_title'] = $arabic_data['title'];
		}
			
			
		$arabic_data['meta_description'] = $request->arabic_meta_description;
		$arabic_data['type'] = 'template';
		
		$arabic_dat = ArabicArticle::create($arabic_data);
		$arabic_article_id = $arabic_dat->id;
		$template = ArabicArticle::where('id',$arabic_article_id)->where('type','template')->first();
		$arabic_pdfile = $template->files;
		$arabic_pdfile_url = url('/uploads/templates/'.$arabic_pdfile);
		
		$arabic_path_info = pathinfo(public_path($arabic_pdfile));
		
		$dataInsert2['preview_imgs'] = NULL; ///$this->makeImagesFromPDF($arabic_pdfile,$arabic_path_info,$arabic_pdfile_url,$arabic_article_id);
		
		$arabic_article_update  = ArabicArticle::where('id', '=', $arabic_article_id);
		
		$arabic_article_update->update($dataInsert2);
		$this->modifyArabicCategorySort($arabic_article_id);
			
		
		return true;
		
	}
	
	
	public function sortList(SortTemplateRequest $request){
		$data = [];
    	$data['success'] = false;
    	$data['message'] = 'Invalid Request';
		if($request->ajax()){
			$sortList = $request->list;
			$page_number = $request->page_number;
			$lang = $request->page_language;
			if($lang == 'ar'){
				$table = new ArabicArticle();
			}else{
				$table = new Article();
			}
			
			if(count($sortList) > 0){
				foreach($sortList as $key => $list) {
					if(!empty($list)){
						$templates = $table::where('type','template')->find($list);
						$newkey = (($page_number-1) * 10)+$key; 
						$templates->position_order= $newkey+1;
						$templates->save(); 
					}
					
				}
			}

			//Pagination
			
			
			if($lang == 'ar'){
				$forms_data = $this->template_search_arabic($request,$pagination=true);
			}else{
				$forms_data = $this->template_search($request,$pagination=true);
			}
			
			$listTemplates = [];
			$page_number = 1;
			if($forms_data['success']){
				$listTemplates = $forms_data['templates'];
				$page_number =  $forms_data['current_page'];
				$number_of_records =  $forms_data['number_of_records'];
				if(empty($page_number))
					$page_number = 1;
			}

			$data['success'] = true;
			$data['message'] = 'Templates Sort Successfully.';
			
			if($lang == 'ar'){
				$data['view'] = view('admin.templates.templatePagination-arabic', compact('listTemplates','page_number','number_of_records'))->render();
			}else{
				$data['view'] = view('admin.templates.templatePagination', compact('listTemplates','page_number','number_of_records'))->render();
			}
			
			
			
			
		}
		return Response::json($data, 200);
	}
	
	public function modifyCategorySort($category_id){
		if(!empty($category_id)){
			$categories = Article::where('type','template')->where('position_order','!=',NULL)->get();
			if(count($categories) > 0){
				foreach($categories as $key => $cat) {
					$category = Article::find($cat->id);
					$category->position_order=($cat->position_order)+1;
					$category->save();
				}
			}

			$newCategory = Article::find($category_id);
			$newCategory->position_order=1;
			$newCategory->save();
		}
	}
	public function modifyArabicCategorySort($category_id){
		if(!empty($category_id)){
			$categories = ArabicArticle::where('type','template')->where('position_order','!=',NULL)->get();
			if(count($categories) > 0){
				foreach($categories as $key => $cat) {
					$category = ArabicArticle::find($cat->id);
					$category->position_order=($cat->position_order)+1;
					$category->save();
				}
			}

			$newCategory = ArabicArticle::find($category_id);
			$newCategory->position_order=1;
			$newCategory->save();
		}
	}
	
	
	public function template_delete(Request $request,$template_id){
		$lang = $request->lang;
		if($template_id){
			if($lang == 'ar'){
				$table = new ArabicArticle();
			}else{
				$table = new Article();
			}
			
			$template  = $table::where('id',$template_id)->first();
			
			if($template){
				$table::where('id',$template_id)->delete();
				$result =array('success' => true);	
				return Response::json($result, 200);
			}else{
				$result =array('success' => false,'message'=>'No template Found');	
				return Response::json($result, 200);
			}
			
		}
	}
	
	public function export_templates(Request $request)
	{
		$templates_data = $this->template_search($request,$pagination = false);
		
		$templates  = $templates_data['templates'];
		
		if($templates && count($templates) > 0){
			$records = [];
			foreach ($templates as $key => $template) {
				$records[$key]['sl_no'] = ++$key;
				$records[$key]['title'] = $template->title;
				$records[$key]['created_at'] = $template->created_at  ?? '';
				$records[$key]['modified_at'] = $template->created_at  ?? '';
				$records[$key]['status'] = $template->status  == 1 ? 'Published' : 'Draft';
				$records[$key]['downloads'] = $template->total_dwlnd_pdf  ?? '';
				$records[$key]['views'] =  $template->total_viewed  ?? '' ;
				$records[$key]['shared'] =  $template->views  ?? '' ;
				$records[$key]['payment'] =  $template->payment  ?? '';
				$records[$key]['category'] =  $template->category  ?? '';
				$records[$key]['is_featured'] =  $template->is_featured  ? 'Yes' : 'No';
				$records[$key]['featured_image'] =  $template->featured_image  ?? '';
				$records[$key]['files'] =  $template->files  ?? '';
				$records[$key]['slideshow'] =  $template->slideshow  ?? '';
				$records[$key]['editableFile'] =  $template->editableFile  ?? '';
				$records[$key]['meta_title'] =  $template->meta_title  ?? ''; 	
				$records[$key]['meta_description'] =  $template->meta_description  ?? '';
			}
			$header = ['S.No', 'Title', 'Date Published','Date Modified', 'Status', 'Number of Downloads', 'Number of Views', '#of times Shared', 'Source of Payment','Category','Is Featured','Featured Image','Files','Slideshow','EditableFile','Meta Title','Meta Description'];
		

			//load the CSV document from a string
			$csv = Writer::createFromString('');

			//insert the header
			$csv->insertOne($header);

			//insert all the records
			$csv->insertAll($records);
			@header("Last-Modified: " . @gmdate("D, d M Y H:i:s",$_GET['timestamp']) . " GMT");
			@header("Content-type: text/x-csv");
			// If the file is NOT requested via AJAX, force-download
			if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
				header("Content-Disposition: attachment; filename=search_results.csv");
			}
			//
			//Generate csv
			//
			echo $csv;
			exit();
		}else{
			$result =array('success' => false);	
		    return Response::json($result, 200);
		}
		
	}
	// ENABLE/DISABLE 
	public function enableDisable(Request $request)
	{
		$lang = $request->lang;
		if($lang == 'ar'){
			$table = new ArabicArticle();
		}else{
			$table = new Article();
		}
		
		if($request->ajax()){
			$template = $table::where('id',$request->user_id)->where('type','template');

			$data =array();
			$data['status'] =  $request->status;
			$template->update($data);
			
			// Show message on the basis of status 
			if($request->status==1)
			 $enable =true ;
			if($request->status==0)
			 $enable =false ;
		  
		   $result =array('success' => $enable);	
		   return Response::json($result, 200);
		}
		
	}
	
	
	public function arabic_slug($string, $separator = '-') {
		if (is_null($string)) {
			return "";
		}

		$string = trim($string);

		$string = mb_strtolower($string, "UTF-8");;

		$string = preg_replace("/[^a-z0-9_\sءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "", $string);

		$string = preg_replace("/[\s-]+/", " ", $string);

		$string = preg_replace("/[\s_]/", $separator, $string);

		return $string;
	}
}
?>