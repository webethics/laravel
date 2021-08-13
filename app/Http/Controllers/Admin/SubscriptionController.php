<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePlanRequest;
use App\Http\Requests\UpdatePlanRequest;
use App\Http\Requests\CreateFeatureRequest;
use Auth;
use Config;
use Session;
use App\Models\Plan;
use App\Models\User;
use App\Models\Subscription;
use App\Models\PlanFeature;
use Response;
use Illuminate\Support\Str;

class SubscriptionController extends Controller
{
	private $featured_image_path;
	protected $per_page;
	
	public function __construct()
    {
		
	    $this->per_page = Config::get('constant.per_page');
    }
	
	
	public function paymentlisting(Request $request)
    {
		
		$plans_data = $this->Subscription_search($request,$pagination=true);
		
		if($plans_data['success']){
			$Subscription = $plans_data['Subscription'];
			$page_number =  $plans_data['current_page'];
			if(empty($page_number))
				$page_number = 1;
			
			if(!is_object($Subscription)) return $Subscription;
			if ($request->ajax()) {
				return view('admin.subscription.subscriptionlisting', compact('Subscription','page_number'));
			}
			return view('admin.subscription.index',compact('Subscription','page_number','roles'));	
		}else{
			return $plans_data['message'];
		}
	}
	
	
	public function Subscription_search($request,$pagination)
	{
		
		$page_number = $request->page;
		$number_of_records =$this->per_page;
		
		
		$result = Subscription::where(`1`, '=', `1`);
			
		
		if($pagination == true){
			$Subscription = $result->orderBy('created_at', 'desc')->paginate($number_of_records);
		}else{
			$Subscription = $result->orderBy('created_at', 'desc')->get();
		}
		
		if(isset($Subscription) && !empty($Subscription)){
			foreach($Subscription as $val){
				$get_user = User::where('id',$val->user_id)->first();
				$val['first_name'] = $get_user->first_name;
				$val['last_name'] = $get_user->last_name;
				$val['email'] = $get_user->email;
			}
		}
		
		$data = array();
		$data['success'] = true;
		$data['Subscription'] = $Subscription;
		$data['current_page'] = $page_number;
		return $data;
	}
}
?>