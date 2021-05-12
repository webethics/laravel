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

use App\Models\PlanFeature;
use Response;
use Illuminate\Support\Str;

class PlansController extends Controller
{
	private $featured_image_path;
	protected $per_page;
	
	public function __construct()
    {
	
	    $this->per_page = Config::get('constant.per_page');
		
		if(config("paypal.paypal_mode") == 'sandbox'){
			 $this->client_id = config("paypal.sandbox_client_id");
			$this->secret = config("paypal.sandbox_secret");
			$this->api_url = config("paypal.sandbax_api_url");
		}
		if(config("paypal.paypal_mode") == 'live'){
			 $this->client_id = config("paypal.live_client_id");
			$this->secret = config("paypal.live_secret");
			$this->api_url = config("paypal.live_api_url");
		}
	
    }
	
	
	public function listplans(Request $request)
    {
		
        $plans_data = $this->plan_search($request,$pagination=true);
		if($plans_data['success']){
			$listPlans = $plans_data['plans'];
			$page_number =  $plans_data['current_page'];
			if(empty($page_number))
				$page_number = 1;
			
			if(!is_object($listPlans)) return $listPlans;
			if ($request->ajax()) {
				return view('admin.plans.plansPagination', compact('listPlans','page_number'));
			}
			return view('admin.plans.index',compact('listPlans','page_number','roles'));	
		}else{
			return $plans_data['message'];
		}
		
		
	}
	
	public function plan_search($request,$pagination)
	{
		
		$page_number = $request->page;
		$number_of_records =$this->per_page;
		
		
		$result = Plan::where(`1`, '=', `1`);
			
		
		if($pagination == true){
			$plans = $result->orderBy('created_at', 'desc')->paginate($number_of_records);
		}else{
			$plans = $result->orderBy('created_at', 'desc')->get();
		}
		
		
		$data = array();
		$data['success'] = true;
		$data['plans'] = $plans;
		$data['current_page'] = $page_number;
		return $data;
	}
	
	
	public function plan_edit($plan_id)
    {
		 $plan = Plan::where('id',$plan_id)->first();
		
		/* $roles = Role::all(); */
		if($plan){
			return view('admin.plans.planEdit' , compact('plan'));
			$success = true;
		}else{
			$view = '';
			$success = false;
		}
	}
	
	public function plan_create()
    {
		return view('admin.plans.planCreate');
		
	}
	
	public function add_features($plan_id)
    {
		$plan = Plan::where('id',$plan_id)->with('features')->first();
	//	pr($plan->toArray());
		return view('admin.plans.planFeatures',compact('plan'));
		
	}
	
	public function update_plan(UpdatePlanRequest $request)
    {
		
		if($request->input()){
			$mem_length = $request->input('membership_length');
			
			if($mem_length == 1 || $mem_length == 0){
				
				$username = 	$this->client_id;
				$password  = $this->secret;
				$url = $this->api_url . '/v1/oauth2/token'; 
				$headers = array(
					'Content-Type: application/x-www-form-urlencoded',
					'Authorization: Basic '. base64_encode("$username:$password")
				);

				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS , rawurldecode(http_build_query(array(
					'grant_type' => 'client_credentials'
				  ))));
				
				$response = curl_exec($ch);
				//echo '<pre>';print_r($response);die;
				if(curl_errno($ch)){
					 $result['success']=false;
					 $result['msg']='Request Error:' . curl_error($ch);
					 $result['access_token']='';
					 return Response::json($result,200);
				}
				$json = json_decode($response);
				$accessToken = $json->access_token;
				$planname = $request->input('title');
				$plan_desc = trim(strip_tags($request->input('description')));
				$pdescription = preg_replace('/[^\w]/', ' ', $plan_desc);
				
				echo $feeusd = $request->input('price');
				
				$status = $request->input('status');
				$plan_id = $request->input('plan_id');
				if($status == 1){
					$statval = "ACTIVE";
				}else{
					$statval = "INACTIVE";
				}
				$paypal_plan_id = $request->input('paypal_plan_id');

				$urln =  $this->api_url.'/v1/billing/plans/'.$paypal_plan_id.'/';
				$headers = array(
					'Content-Type: application/json',
					 'Authorization: Bearer ' . $accessToken
				);
				$curl = curl_init($urln);
				//curl_setopt($curl, CURLOPT_URL, $urln);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH');
				curl_setopt($curl, CURLOPT_POSTFIELDS, '[{ "op": "replace", "path": "/description", "value": "'.$pdescription.'" }]');
				curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
				$response1 = curl_exec($curl);
				$info = curl_getinfo($curl);
				
				 $urln1 =   $this->api_url.'/v1/billing/plans/'.$paypal_plan_id.'/update-pricing-schemes';
				$headers = array(
					'Content-Type: application/json',
					 'Authorization: Bearer ' . $accessToken
				);
				$curl1 = curl_init($urln1);
				curl_setopt($curl1, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($curl1, CURLOPT_POSTFIELDS, '{ "pricing_schemes": [{ "billing_cycle_sequence": 1, "pricing_scheme": { "fixed_price": {"value": "'.$feeusd.'", "currency_code": "USD"    }  } } ]}');
				curl_setopt($curl1, CURLOPT_HTTPHEADER, $headers);
				 $response2 = curl_exec($curl1);
				
				$res1 = json_decode($response2);
				
				if($res1 && $res1->details != ""){
					$issue = $res1->details;
					echo $issue[0]->description;
					Session::flash('success', $issue[0]->description);
				}
				$arabic_title = $request->input('arabic_title');
				$title = $request->input('title');
				$slug = $request->input('slug');
				$description = $request->input('description');
				$arabic_description = $request->input('arabic_description');
				$plan_id = $request->input('plan_id');
				$price = $request->price;
				$status = $request->status;

				$membership_length = $request->membership_length;
				$num_of_users = $request->number_of_users;
				
				$display_order = $request->display_order;
				$data = array('title'=>$title,'arabic_title'=>$arabic_title,'slug'=>$slug,'description'=>$description,'arabic_description'=>$arabic_description,'price'=>$price,'display_order'=>$display_order,'status'=>$status,'mem_length'=>$membership_length,'num_of_users'=>$num_of_users);
				$plan_update  = Plan::where('id', '=', $plan_id);
				$plan_update->update($data);
				
				
				curl_close($curl);
				
			}else if($mem_length == 2){
				$username = 	$this->client_id;
				$password  = $this->secret;
				$url = $this->api_url . '/v1/oauth2/token'; 
				$headers = array(
					'Content-Type: application/x-www-form-urlencoded',
					'Authorization: Basic '. base64_encode("$username:$password")
				);

				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS , rawurldecode(http_build_query(array(
					'grant_type' => 'client_credentials'
				  ))));
				
				$response = curl_exec($ch);
				//echo '<pre>';print_r($response);die;
				if(curl_errno($ch)){
					 $result['success']=false;
					 $result['msg']='Request Error:' . curl_error($ch);
					 $result['access_token']='';
					 return Response::json($result,200);
				}
				$json = json_decode($response);
				$accessToken = $json->access_token;
				$planname = $request->input('title');
				$plan_desc = trim(strip_tags($request->input('description')));
				$pdescription = preg_replace('/[^\w]/', ' ', $plan_desc);
				
				echo $feeusd = $request->input('price');
				
				$status = $request->input('status');
				$plan_id = $request->input('plan_id');
				if($status == 1){
					$statval = "ACTIVE";
				}else{
					$statval = "INACTIVE";
				}
				$paypal_plan_id = $request->input('paypal_plan_id');

				$urln =  $this->api_url.'/v1/billing/plans/'.$paypal_plan_id.'/';
				$headers = array(
					'Content-Type: application/json',
					 'Authorization: Bearer ' . $accessToken
				);
				$curl = curl_init($urln);
				//curl_setopt($curl, CURLOPT_URL, $urln);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH');
				curl_setopt($curl, CURLOPT_POSTFIELDS, '[{ "op": "replace", "path": "/description", "value": "'.$pdescription.'" }]');
				curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
				$response1 = curl_exec($curl);
				$info = curl_getinfo($curl);
				
				 $urln1 =   $this->api_url.'/v1/billing/plans/'.$paypal_plan_id.'/update-pricing-schemes';
				$headers = array(
					'Content-Type: application/json',
					 'Authorization: Bearer ' . $accessToken
				);
				$curl1 = curl_init($urln1);
				curl_setopt($curl1, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($curl1, CURLOPT_POSTFIELDS, '{ "pricing_schemes": [{ "billing_cycle_sequence": 1, "pricing_scheme": { "fixed_price": {"value": "'.$feeusd.'", "currency_code": "USD"    }  } } ]}');
				curl_setopt($curl1, CURLOPT_HTTPHEADER, $headers);
				 $response2 = curl_exec($curl1);
				
				$res1 = json_decode($response2);
				
				if($res1 && $res1->details != ""){
					$issue = $res1->details;
					echo $issue[0]->description;
					Session::flash('success', $issue[0]->description);
				}
				$arabic_title = $request->input('arabic_title');
				$title = $request->input('title');
				$slug = $request->input('slug');
				$description = $request->input('description');
				$arabic_description = $request->input('arabic_description');
				$plan_id = $request->input('plan_id');
				$price = $request->price;
				$status = $request->status;

				$membership_length = $request->membership_length;
				$num_of_users = $request->number_of_users;
				
				$display_order = $request->display_order;
				$data = array('title'=>$title,'arabic_title'=>$arabic_title,'slug'=>$slug,'description'=>$description,'arabic_description'=>$arabic_description,'price'=>$price,'display_order'=>$display_order,'status'=>$status,'mem_length'=>$membership_length,'num_of_users'=>$num_of_users);
				$plan_update  = Plan::where('id', '=', $plan_id);
				$plan_update->update($data);
				
				
				curl_close($curl);
				
			}
			Session::flash('success', 'Plan has been Updated.');
			return redirect('admin/plans/edit/'.$plan_id); 
		}
		
		
	}
	
	public function create_plan(CreatePlanRequest $request){
		
		$responsedata = [];
    	$responsedata['success'] = false;
    	$responsedata['message'] = 'Invalid Request';
		
		$username = 	$this->client_id;
		$password  = $this->secret;
		$url = $this->api_url . '/v1/oauth2/token'; 
	
		$headers = array(
			'Content-Type: application/x-www-form-urlencoded',
			'Authorization: Basic '. base64_encode("$username:$password")
		);

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS , rawurldecode(http_build_query(array(
			'grant_type' => 'client_credentials'
		  ))));
		
		$response = curl_exec($ch);
		
		if(curl_errno($ch)){
			 $result['success']=false;
			 $result['msg']='Request Error:' . curl_error($ch);
			 $result['access_token']='';
			 return Response::json($result,200);
		}
		$json = json_decode($response);
		$accessToken = $json->access_token;
		$planname = $request->input('title');
		$plan_desc = trim(strip_tags($request->input('description')));
		$pdescription = preg_replace('/[^\w]/', ' ', $plan_desc);
		
		$feeusd = $request->input('price');
		
		$status = $request->input('status');
		$plan_id = $request->input('plan_id');
		if($status == 1){
			$statval = "ACTIVE";
		}else{
			$statval = "INACTIVE";
		}
		
		$paypal_plan_id = $request->input('paypal_plan_id');

		$urln =  $this->api_url.'/v1/billing/plans/';
		$headers = array(
			'Content-Type: application/json',
			 'Authorization: Bearer ' . $accessToken
		);
		$interval_unit = '';
		$total_cycle = 12;
		if($request->membership_length == 0){
			$interval_unit = 'MONTH';
			$total_cycle = 12;
		}else if($request->membership_length == 1){
			$interval_unit = 'YEAR';
			$total_cycle = 12;
		}else if($request->membership_length == 2){
			$interval_unit = 'YEAR';
			$total_cycle = 999;
		}
		$curl = curl_init($urln);
		 $requestdata = '{
			  "product_id": "PROD-2VT135561R156923B",
			  "name": "'.$request->title.'",
			  "description": "'.$request->description.'",
			  "status": "ACTIVE",
			  "billing_cycles": [
				{
				  "frequency": {
					"interval_unit": "'.$interval_unit.'",
					"interval_count": 1
				  },
				  "tenure_type": "REGULAR",
				  "sequence": 1,
				  "total_cycles": '.$total_cycle.',
				  "pricing_scheme": {
					"fixed_price": {
					  "value": "'.$feeusd.'",
					  "currency_code": "USD"
					}
				  }
				}
			  ],
			  "payment_preferences": {
				"auto_bill_outstanding": false,
				"setup_fee": {
				  "value": "0",
				  "currency_code": "USD"
				},
				"setup_fee_failure_action": "CONTINUE",
				"payment_failure_threshold": 3
			  }
			  
			}';
		//curl_setopt($curl, CURLOPT_URL, $urln);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($curl, CURLOPT_POSTFIELDS,$requestdata);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		$response1 = curl_exec($curl);
		$res1 = json_decode($response1);
		
		$info = curl_getinfo($curl);
		
		/* $urln1 =   $this->api_url.'/v1/billing/plans/'.$paypal_plan_id.'/update-pricing-schemes';
		$headers = array(
			'Content-Type: application/json',
			 'Authorization: Bearer ' . $accessToken
		);
		$curl1 = curl_init($urln1);
		curl_setopt($curl1, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($curl1, CURLOPT_POSTFIELDS, '{ "pricing_schemes": [{ "billing_cycle_sequence": 1, "pricing_scheme": { "fixed_price": {"value": "'.$feeusd.'", "currency_code": "USD"    }  } } ]}');
		curl_setopt($curl1, CURLOPT_HTTPHEADER, $headers);
		 $response2 = curl_exec($curl1);
		
		$res1 = json_decode($response2);
		
		if($res1 && $res1->details != ""){
			$issue = $res1->details;
			echo $issue[0]->description;
			Session::flash('success', $issue[0]->description);
		} */
		
		
		//if($request->ajax()){
		$data =array();
		$data['title']	= $request->title;
		$data['arabic_title']	= $request->arabic_title;
		$data['slug'] =  create_slugify($request->title);
		$data['description'] = $request->description;
		$data['arabic_description'] = $request->arabic_description;
		$data['price'] = $request->price;
		
		$data['display_order'] = $request->display_order;
		$data['status'] = $request->status;
		$data['plan_id'] = $res1->id;
		$data['mem_length'] = $request->membership_length;
		$data['num_of_users'] = $request->number_of_users;
		
		$dat = Plan::create($data);
		
		Session::flash('success', 'New Plan created Successfully.');
		return redirect('admin/listplans/'); 

		/* $responsedata['success'] = true;
		$responsedata['message'] = 'New Plan created Successfully';
			 */
		//}
		return $response;
		
	}
	
	public function add_new_feature(CreateFeatureRequest $request){
		
		$response = [];
    	$response['success'] = false;
    	$response['message'] = 'Invalid Request';
		//if($request->ajax()){
		$data =array();
		$data['feature_text']	= $request->feature_text;
		$data['arabic_feature_text']	= $request->arabic_feature_text;
		$data['plan_id'] = $request->plan_id;
		
		$dat = PlanFeature::create($data);

		$response['success'] = true;
		$response['message'] = 'New Plan created Successfully';
			
		//}
		return redirect('admin/plans/add_features/'.$data['plan_id']);
		
	}
	
	public function plan_delete($plan_id){
		if($plan_id){
			$plan  = Plan::where('id',$plan_id)->first();
			
			if($plan){
				Plan::where('id',$plan_id)->delete();
				$delete_plan_features = PlanFeature::where('plan_id',$plan_id)->delete();
				$result =array('success' => true);	
				return Response::json($result, 200);
			}else{
				$result =array('success' => false,'message'=>'No Plan Found');	
				return Response::json($result, 200);
			}
			
		}
	}
	public function feature_delete($feature_id){
		if($feature_id){
			$feature  = PlanFeature::where('id',$feature_id)->first();
			
			if($feature){
				PlanFeature::where('id',$feature_id)->delete();
				$result =array('success' => true);	
				return Response::json($result, 200);
			}else{
				$result =array('success' => false,'message'=>'No Plan Found');	
				return Response::json($result, 200);
			}
			
		}
	}
	
	// ENABLE/DISABLE 
	public function enableDisable(Request $request)
	{
		if($request->ajax()){
			$template = Plan::where('id',$request->user_id);

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
	
}
?>