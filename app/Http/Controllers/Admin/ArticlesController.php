<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Auth;
use Config;
use Session;
use App\Models\Article;
use Response;
use Illuminate\Support\Str;

class ArticlesController extends Controller
{
	private $featured_image_path;
	protected $per_page;
	public function __construct()
    {
		
	    $this->featured_image_path = public_path('/uploads/articles/featured_image/');
        $this->per_page = Config::get('constant.per_page');
    }
	
	
	public function listarticles(Request $request)
    {
		
        $articles_data = $this->article_search($request,$pagination=true);
		if($articles_data['success']){
			$listArticles = $articles_data['articles'];
			$page_number =  $articles_data['current_page'];
			if(empty($page_number))
				$page_number = 1;
			
			if(!is_object($listArticles)) return $listArticles;
			if ($request->ajax()) {
				return view('admin.articles.articlePagination', compact('listArticles','page_number'));
			}
			return view('admin.articles.index',compact('listArticles','page_number','roles'));	
		}else{
			return $customers_data['message'];
		}
		
		
	}
	
	public function article_search($request,$pagination)
	{
		
		$page_number = $request->page;
		$number_of_records =$this->per_page;
		
		
		$result = Article::where('type','article');
			
		
		if($pagination == true){
			$articles = $result->orderBy('created_at', 'desc')->paginate($number_of_records);
		}else{
			$articles = $result->orderBy('created_at', 'desc')->get();
		}
		
		
		$data = array();
		$data['success'] = true;
		$data['articles'] = $articles;
		$data['current_page'] = $page_number;
		return $data;
	}
	
	
	public function article_edit($article_id)
    {
		 $article = Article::where('id',$article_id)->where('type','article')->first();
		
		/* $roles = Role::all(); */
		if($article){
			return view('admin.articles.articleEdit' , compact('article'));
			$success = true;
		}else{
			$view = '';
			$success = false;
		}
	}
	
	public function article_create()
    {
		return view('admin.articles.articleCreate');
		
	}
	
	public function update_article(UpdateArticleRequest $request)
    {
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
		
		if($request->file('image'))
		{
			$featured_image = $request->file('image');
			$randomString = sha1(date('YmdHis') . Str::random(30));
			$save_name = $randomString . '.' . $featured_image->getClientOriginalExtension();
			$data['featured_image'] = $save_name;
			//Move Uploaded File
			$featured_image->move($this->featured_image_path, $save_name);
		} 
		
		
		$article_update  = Article::where('id', '=', $article_id);
	//	echo '<pre>';print_r($data);die;
		$article_update->update($data);
		Session::flash('success', 'Article has been Updated.');
		return redirect('admin/articles/edit/'.$article_id); 
		
		
	}
	
	public function create_article(CreateArticleRequest $request){
		
		$response = [];
    	$response['success'] = false;
    	$response['message'] = 'Invalid Request';
		//if($request->ajax()){
		$data =array();
		$data['title']	= $request->title;
		$data['slug'] =  create_slugify($request->title);
		$data['description'] = $request->description;
		$data['excerpt'] = $request->excerpt;
		$data['is_featured'] = $request->is_featured;
		$data['is_protected'] = $request->is_protected;
		$data['status'] = $request->status;
		$data['category'] = $request->category;
		$data['author'] = $request->author;
		$data['views'] = 0;
		$featured_image = $request->file('image');
		
		
		if (!is_dir($this->featured_image_path)) {
			mkdir($this->featured_image_path, 0777);
		}
		
		$randomString = sha1(date('YmdHis') . Str::random(30));
		$save_name = $randomString . '.' . $featured_image->getClientOriginalExtension();
		$data['featured_image'] = $save_name;
		//Move Uploaded File
		$featured_image->move($this->featured_image_path, $save_name);
		  
		  
		if($request->meta_title){
			$data['meta_title'] = $request->meta_title;
		}else{
			$dataInsert['meta_title'] = $data['title'];
		}
			
			
		$data['meta_description'] = $request->meta_description;
		$data['type'] = 'article';
		
		$dat = Article::create($data);

		$response['success'] = true;
		$response['message'] = 'New Article created Successfully';
			
		//}
		return redirect('admin/listarticles');
		
	}
	
	public function article_delete($article_id){
		if($article_id){
			$Article  = Article::where('id',$article_id)->first();
			
			if($Article){
				Article::where('id',$article_id)->delete();
				$result =array('success' => true);	
				return Response::json($result, 200);
			}else{
				$result =array('success' => false,'message'=>'No Article Found');	
				return Response::json($result, 200);
			}
			
		}
	}
	
}
?>