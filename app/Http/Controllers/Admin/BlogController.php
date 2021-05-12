<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\CommonController;
use Illuminate\Http\Request;
use App\Http\Requests\CreateBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Http\Requests\SortBlogRequest;
use App\Http\Requests\CreateTempFeatureMediaRequest;
use App\Http\Requests\FetchBlogMediaRequest;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\TempMedia;
use Config;
use Session;
use Response;
use File;
use Carbon\Carbon;

class BlogController extends Controller
{
	protected $per_page;
	public function __construct()
    {
	    
        //$this->per_page = Config::get('constant.per_page');
        $this->per_page = 20;
        $this->blog_path = public_path('/uploads/blog');
        $this->temp_auction_path = public_path('/uploads/temp_auctions');
    }

    public function blogs(Request $request)
    {
		
    	access_denied_user('blog_listing');

    	$blog_data = $this->blog_search($request,$pagination=true);
		if($blog_data['success']){
			$blogs = $blog_data['blogs'];
			$page_number =  $blog_data['current_page'];
			if(empty($page_number))
				$page_number = 1;
			
			if(!is_object($blogs)) return $blogs;
			if ($request->ajax()) {
				return view('admin.blog.blogPagination', compact('blogs','page_number'))->render();
			}
			return view('admin.blog.index',compact('blogs','page_number'));	
		}else{
			return $blog_data['message'];
		}
    }

    public function blogsCategories(Request $request)
    {
		
    	access_denied_user('blog_categories_create');
       
    	$blog_cat_data = BlogCategory::all();
			$blogs = $blog_cat_data;
			//$page_number =  $blog_data['current_page'];
			if(empty($page_number))
				$page_number = 1;
			
			if(!is_object($blogs)) return $blogs;
			if ($request->ajax()) {
				return view('admin.blog.blogCategoriesPagination', compact('blogs','page_number'))->render();
            }
          
			return view('admin.blog.blogCategories',compact('blogs','page_number'));	
		
    }

    public function blog_search($request,$pagination)
	{
		
		$page_number = $request->page;
		$number_of_records =$this->per_page;
		$title = $request->title;
		$content = $request->content;
		
		$result = Blog::where(`1`, '=', `1`);
			
		if($title !='' || $content !=''){
			$title_q = '%' . $request->title .'%';
			// check title 
			if(isset($title) && !empty($title)){
				$result->where('title','LIKE',$title_q);
			} 
			
			$content_s = '%' . $content . '%';
			
			// check content 
			if(isset($content) && !empty($content)){
				$result->where('content','LIKE',$content_s);
			}
		}
		
		//echo $result->orderBy('created_at', 'desc')->toSql();die;
		
		if($pagination == true){
			$blogs = $result->orderBy('position')->paginate($number_of_records);
		}else{
			$blogs = $result->orderBy('position')->get();
		}
		
		
		$data = array();
		$data['success'] = true;
		$data['blogs'] = $blogs;
		$data['current_page'] = $page_number;
		return $data;
    }
    

	/*Get request create view*/
	public function create()
    {
		access_denied_user('blog_create');

		return view('admin.blog.blogForm');
    }

    /*Get request create view*/
	public function createBlogsCategories()
    {
		access_denied_user('blog_categories_create');

		return view('admin.blog.blogCategoryForm');
    }


    public function store(CreateBlogRequest $request){
			$data =array();
			$data['title']	= $request->title;
			$data['slug'] = CommonController::createSlug(trim($request->title),'blog');
			$data['content']	= $request->content;
			$blog_cat_id = implode(', ', $request->auction_cat);
			$data['auction_cat']	= $blog_cat_id;
			//$data['sale_start_on'] = Carbon::parse($request->sale_start_on)->format('Y-m-d H:i:s'); //22-10-2020 09:31:13
			//$data['sale_end_on'] = Carbon::parse($request->sale_end_on)->format('Y-m-d H:i:s');
			
			$dat = Blog::create($data);

			$blog_id = $dat->id;

			$image = $request->file('image');

			if(!empty($image)){
				//print_r($image->getClientOriginalExtension());
				//print_r($image->getClientOriginalName());
				$new_name = rand() . '_blogs_' . $image->getClientOriginalName();

				//CREATE auction FOLDER IF NOT 
				if (!is_dir($this->blog_path)) {
					mkdir($this->blog_path, 0777);
				}
				//CREATE auction ID FOLDER 
				$blog_id_path = $this->blog_path.'/'.$blog_id;
				if (!is_dir($blog_id_path)) {
					mkdir($blog_id_path, 0777);
				}
				$image->move($blog_id_path, $new_name);
				$blogUpdate = Blog::where('id',$blog_id);
				$imagedata = array();
				$imagedata['image'] = $new_name;
				$imagedata['original_image'] = $image->getClientOriginalName();
				$imagedata['mimes'] = trim($image->getClientOriginalExtension());
				$blogUpdate->update($imagedata);
			
		   }

			//modify blog position
			$this->modifyBlogSort($blog_id);

			Session::flash('success', 'Blog has been Created.');
			//return redirect('admin/blog/edit/'.$blog_id);
			return redirect('admin/blogs');
    }
    
    public function storeBlogsCategories(Request $request){
            //die('Loading');
            $data =array();
			$data['name']	= $request->title;
			if($data['name'] != ''){
           
            $dat = BlogCategory::create($data);

            $blog_id = $dat->id;

				//Session::flash('success', 'Blog Category has been Created.');
				return redirect()->back()->with('success','Blog Category has been Created.');
			} else{
				//Session::flash('error', 'Blog Category cannot be empty.');
				return redirect()->back()->with('error','Blog Category cannot be empty');
			}
			//return redirect('admin/blog/edit/'.$blog_id);
            //return redirect('admin/blog-categories');
    }

    

	
	public function blog_edit($blog_id){
		access_denied_user('blog_categories_edit');
        $blog = Blog::where('id',$blog_id)->first();

		return view('admin.blog.blogForm',compact('blog'));
    }

    public function editBlogsCategories($blog_cat_id){
		access_denied_user('blog_categories_edit');
        $blog = BlogCategory::where('id',$blog_cat_id)->first();

		return view('admin.blog.blogCategoryForm',compact('blog'));
    }


	public function update_blog(UpdateBlogRequest $request){
		$blog_id = trim($request->blog_id);
		if(!empty($blog_id)){
			$data =array();
			$data['title']	= trim($request->title);
			$data['content']	= trim($request->content);
			$blog_cat_id = implode(', ', $request->auction_cat);
			$data['auction_cat']	= $blog_cat_id;
			//$data['sale_start_on'] = Carbon::parse($request->sale_start_on)->format('Y-m-d H:i:s'); //22-10-2020 09:31:13
			//$data['sale_end_on'] = Carbon::parse($request->sale_end_on)->format('Y-m-d H:i:s');
			$image = $request->file('image');

				if(!empty($image)){
					//print_r($image->getClientOriginalExtension());
					//print_r($image->getClientOriginalName());
					$new_name = rand() . '_blogs_' . $image->getClientOriginalName();

					//CREATE auction FOLDER IF NOT 
					if (!is_dir($this->blog_path)) {
						mkdir($this->blog_path, 0777);
					}
					//CREATE auction ID FOLDER 
					$blog_id_path = $this->blog_path.'/'.$blog_id;
					if (!is_dir($blog_id_path)) {
						mkdir($blog_id_path, 0777);
					}
					$image->move($blog_id_path, $new_name);
					$main  = Blog::where('id',$blog_id)->first();
					if($main){
					 $path = $this->blog_path.'/'.$blog_id.'/'.$main->image;
				     @unlink($path); 
					}
					$data['image'] = $new_name;
					$data['original_image'] = $image->getClientOriginalName();
					$data['mimes'] = trim($image->getClientOriginalExtension());
				}

			$blogUpdate = Blog::where('id',$blog_id);
			$blogUpdate->update($data);

			//dd($blog_id);

			Session::flash('success', 'Blog edit successfully.');

		}else{
			Session::flash('success', 'Something went wrong, please try again.');
		}
		return redirect('admin/blog/edit/'.$blog_id);
    }

    public function updateBlogsCategories(Request $request){
      
		$blog_id = trim($request->blog_id);
		if(!empty($blog_id)){
			$data =array();
			$data['name']	= trim($request->title);
			
			if($request->title != ''){
			$blogUpdate = BlogCategory::where('id',$blog_id);
			$blogUpdate->update($data);

			//dd($blog_id);

				return redirect()->back()->with('success','Blog Category has been Created.');
			} else {
				return redirect()->back()->with('error','Blog Category cannot be empty');
			}
		}else{
			Session::flash('success', 'Something went wrong, please try again.');
		}
		return redirect('admin/blog-categories/edit/'.$blog_id);
    }
    
    

	/*Delete Blog*/
	public function blog_delete(Request $request,$blog_id){
		access_denied_user('blog_delete');
		$data = [];
    	$data['success'] = false;
    	$data['message'] = 'Invalid Request';
		if($blog_id){
			$main  = Blog::where('id',$blog_id)->first();
			if($main){
				   
				    $path = $this->blog_path.'/'.$blog_id.'/'.$main->image;
				    @unlink($path); 
					
					$path1 = $this->blog_path.'/'.$blog_id;
					@rmdir($path1);
				   
					Blog::where('id',$blog_id)->delete();

					$blog_data = $this->blog_search($request,$pagination=true);
					$blogs = [];
					$page_number = 1;
					if($blog_data['success']){
						$blogs = $blog_data['blogs'];
						$page_number =  $blog_data['current_page'];
						if(empty($page_number))
							$page_number = 1;
					}

					$data['success'] = true;
					$data['message'] = 'Successfully Delete Blog.';
					$data['view'] = view('admin.blog.blogPagination', compact('blogs','page_number'))->render();

			}else{
				$data['message'] = 'There is no Blog found.';
			}
		}
		return Response::json($data, 200);
    }

    /*Delete Blog category*/

	public function deleteBlogsCategories(Request $request,$blog_id){
		access_denied_user('blog_categories_delete');
		$data = [];
    	$data['success'] = false;
    	$data['message'] = 'Invalid Request';
		if($blog_id){
			$main  = BlogCategory::where('id',$blog_id)->first();
			if($main){
				   
				$blogs =  BlogCategory::all();
				   
                BlogCategory::where('id',$blog_id)->delete();
                if(empty($page_number))
				$page_number = 1;

                $data['success'] = true;
                $data['message'] = 'Successfully Deleted Blog Category.';
                $data['view'] = view('admin.blog.blogCategoriesPagination', compact('blogs','page_number'))->render();

			}else{
				$data['message'] = 'There is no Blog found.';
			}
		}
		return Response::json($data, 200);
    }
    
    

	public function enableDisableBlog(Request $request){
		if($request->ajax()){
			$blog = Blog::where('id',$request->blog_id);

			$data =array();
			$data['status'] =  $request->status;
			$blog->update($data);
			
			// Show message on the basis of status 
			if($request->status==1)
			 $enable =true ;
			if($request->status==0)
			 $enable =false ;
		  
		   $result =array('success' => $enable);	
		   return Response::json($result, 200);
		}
	}

	//Sort blog position
	public function sortList(SortBlogRequest $request){
		$data = [];
    	$data['success'] = false;
    	$data['message'] = 'Invalid Request';
		if($request->ajax()){
			$sortList = $request->list;
			if(count($sortList) > 0){
				foreach($sortList as $key => $list) {
					if(!empty($list)){
						$blog = Blog::find($list);
						$blog->position=$key+1;
						$blog->save();
					}
					
				}
			}

			//Pagination
			$blog_data = $this->blog_search($request,$pagination=true);
			$blogs = [];
			$page_number = 1;
			if($blog_data['success']){
				$blogs = $blog_data['blogs'];
				$page_number =  $blog_data['current_page'];
				if(empty($page_number))
					$page_number = 1;
			}

			$data['success'] = true;
			$data['message'] = 'Blog Sort Successfully.';
			$data['view'] = view('admin.blog.blogPagination', compact('blogs','page_number'))->render();
		}
		return Response::json($data, 200);
	}

	//Create New Blog at top
	public function modifyBlogSort($blog_id){
		if(!empty($blog_id)){
			$blogs = Blog::where('position','!=',NULL)->get();
			if(count($blogs) > 0){
				foreach($blogs as $key => $cat) {
					$blog = Blog::find($cat->id);
					$blog->position=($cat->position)+1;
					$blog->save();
				}
			}

			$newBlog = Blog::find($blog_id);
			$newBlog->position=1;
			$newBlog->save();
		}
	}

	//Downlad Image
	public function downloadImage($blog_id){
		if(!empty($blog_id)){
			$blog = Blog::where('id',$blog_id)->firstOrFail();
			if(!empty($blog)){
				//$path = $blog->image_url;
				$path = $this->blog_path.'/'.$blog_id.'/'.$blog->image;
				$headers = ['Content-Type' => $blog->mimes]; $blog->mimes;
				return Response::download($path, $blog->original_image, $headers);
			}
		}
	}


	//delete Image
	public function deleteBlogImage($blog_id){
		$data = [];
    	$data['success'] = false;
    	$data['message'] = 'Invalid Request';
		if($blog_id){
			$main  = Blog::where('id',$blog_id)->firstOrFail();
			if(!empty($main)){
				$blog = Blog::find($blog_id);
				$blog->image='';
				$blog->original_image='';
				$blog->mimes='';
				$blog->save();

				//unlink media
				$path = $this->blog_path.'/'.$blog_id.'/'.$main->image;
				@unlink($path);

				$data['success'] = true;
				$data['message'] = 'Successfully Blog Image Delete.';
				

			}else{
				$data['message'] = 'There is no Blog found.';
			}
		}
		return Response::json($data, 200);
	}

/* 	public function fetchImage(FetchBlogMediaRequest $request){
		$data = [];
    	$data['success'] = false;
    	$data['message'] = 'Invalid Request';
		if($request->ajax()){
			$fileList = array();
			$media_id = trim($request->media_id);
			$request_data = $request->all();
			if (trim($request_data['request']) == 'temp_fetch') {
				//fetch all Ids
				if(!empty($media_id)){
					//Check is feature image or gallery Image
					$tempmedia = TempMedia::where('id', $media_id)->first();
					
					if($tempmedia){
						$data['success'] = true;
						$data['message'] = 'Successfully fetch Feature Media.';
						$data['src'] = $tempmedia->image_url;
					}
				}
			}
		}
		return Response::json($data, 200);
	}

 */

	

}

?>