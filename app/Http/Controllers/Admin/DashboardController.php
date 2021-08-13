<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\EditCategoryRequest;
use Auth;
use Config;use Session;
use App\Models\Article;
use App\Models\ArabicArticle;
use App\Models\Category;
use App\Models\BlogCategory;
use App\Models\Blog;
use App\Models\Leads;
use DB;

use Carbon\Carbon;
// use App\Models\Plan;
use App\Models\User;
use Response;

class DashboardController extends Controller
{
	protected $per_page;
	public function __construct()
    {
	    
        $this->per_page = Config::get('constant.per_page');
    }
	public function index(){
		
		access_denied_user('dashboard_listing');
		// DB::connection()->enableQueryLog();
	
		$leads = Leads::whereMonth('created_at', Carbon::now()->month)
		->count();

		$hired = Leads::whereMonth('created_at', Carbon::now()->month)
		->where('status', 2)
		->count();

		$lost = Leads::whereMonth('created_at', Carbon::now()->month)
		->where('status', 3)
		->count();

		$unresponsive = Leads::whereMonth('created_at', Carbon::now()->month)
		->where('status', 4)
		->count();
	
		
		return view('admin.dashboard.index',compact('leads','hired','lost','unresponsive'));
		// $plans['count'] = Plan::count();
		// $plans['icon'] = 'iconsminds-dollar';
		// $plans['backgroundColor'] = 'aquamarine';
		// $plans['url'] = '/admin/listplans';

		// $users['count'] = User::where('role_id', '!=', 1)->count();
		// $users['icon'] = 'simple-icon-user';
		// $users['backgroundColor'] = 'lightgreen';
		// $users['url'] = '/admin/customers';

		// $blogs['count'] = Blog::count();
		// $blogs['icon'] = 'simple-icon-grid';
		// $blogs['backgroundColor'] = '#f6b21b85';
		// $blogs['url'] = '/admin/blogs';


		// $blogCategory['count'] = BlogCategory::count();
		// $blogCategory['icon'] = 'simple-icon-list';
		// $blogCategory['backgroundColor'] = 'gainsboro';
		// $blogCategory['url'] = '/admin/blog-categories';

		// $dashboard = array('Plans' => $plans, 'Users' => $users, 'Blogs' => $blogs, 'Blog Categories' => $blogCategory);
		return view('admin.dashboard.index');
		/*$listTemplates =  Article::where('type','template')->count();
		$listForms =  Article::where('type','form')->count();
		$listInfographics =  Article::where('type','infographic')->count();
		
		$listTemplatesArabic =  ArabicArticle::where('type','template')->count();
		$listFormsArabic =  ArabicArticle::where('type','form')->count();
		$listInfographicsArabic =  ArabicArticle::where('type','infographic')->count();
		
		return view('admin.dashboard.index',compact('listTemplates','listForms','listInfographics','listTemplatesArabic','listFormsArabic','listInfographicsArabic'));	*/
	}
	
	public function createSubcategory($category){
		
		return view('admin.dashboard.create_subcategories',compact('category'));	
	}
	public function listsubcategory(){
		
		$categories = Category::all();
		return view('admin.dashboard.list_subcategories',compact('categories'));	
	}
	
	public function editSubcategory($category_id){
		
		$category = Category::where('id',$category_id)->first();
		return view('admin.dashboard.edit_subcategories',compact('category'));	
	}
	
	public function createNewSubcategory(CreateCategoryRequest $request){
		
		$data =array();
		$data['sub_category_name']	= $request->name;
		$data['category_name'] = $request->category;
		
		$dat = Category::create($data);

		$response['success'] = true;
		$response['message'] = 'New Sub Categorys created Successfully';
		return redirect('admin/listsubcategories'); 
	}
	
	public function editNewSubcategory(EditCategoryRequest $request){
		
		$name = $request->input('name');
	  
	    $sub_category_id = $request->input('sub_category_id');
	    // update email template
	    $data = array('sub_category_name'=>$name);
		
		$CmsPage_update  = Category::where('id', '=', $sub_category_id);
		
		$CmsPage_update->update($data);
		
		Session::flash('success', 'Sub Category has been Updated.');
		return redirect('admin/edit-sub-categories/'.$sub_category_id); 
		
	}
	public function subcategory_delete($id){
		if($id){
			$category  = Category::where('id',$id)->first();
			
			if($category){
				$article = Article::where('category',$category->sub_category_name)->first();
				if($article){
					$result =array('success' => false,'message'=>'This category can not be deleted. As it is not empty');	
					return Response::json($result, 200);
				}else{
					Category::where('id',$id)->delete();
					$result =array('success' => true);	
					return Response::json($result, 200);
				}
			}else{
				
				$result =array('success' => false,'message'=>'This account can not be deleted');	
				return Response::json($result, 200);
			}
			
		}
		
	}
}
?>