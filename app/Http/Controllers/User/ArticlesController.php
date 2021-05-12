<?php 
namespace App\Http\Controllers\User;

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
        $this->per_page = Config::get('constant.posts_per_page');;
    }
	
	
	public function index()
    {
		$number_of_records =$this->per_page;
		$results = Article::where('type','article')->paginate($number_of_records);
		//pr($articles->toArray());
		return view('frontend.pages.articles.index',compact('results'));
    }
	
	
	
}
?>