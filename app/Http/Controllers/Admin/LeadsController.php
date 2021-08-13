<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\Bidder;
use App\Models\Leads;
use App\Models\Comments;
use App\Models\EmailTemplate;use App\Models\Download;
use App\Models\SocialFacebookAccount;
use App\Models\SocialGoogleAccount;
use App\Models\Subscription;
use League\Csv\Writer;	
use Auth;
use Config;
use Response;
use Session;
use Hash;
use DB;
use DateTime;

use Carbon\Carbon;
use App\Models\Upwork_id;



class LeadsController extends Controller
{

    protected $per_page;
	public function __construct()
    {
	    
        $this->per_page = Config::get('constant.per_page');
    }

     // Leads Listing And Index Page
    public function index(){

        $Leads = leadslisting();
        $bidder = bidder_all();
        $upwork_id = upwork_all();
        
	     $upwork_id_name = Upwork_id::select('upwork_id_name')->where('id',2)->get();
        
        return view('admin.leads.leads',compact('Leads','bidder','upwork_id','upwork_id_name'));
     

    }

    	/*==============================================
	                    // Leads Inserting 
        ============================================*/


    
    public function store(Request $request){
     
        $request->validate([
            'client_name' => 'required',
            'upwork_id' => 'required',
            'job_title' => 'required',
            'job_url' => 'required',
            'client_budget' => 'required',
            'bidder_id' => 'required',
            'status' => 'required',
            
        ]);
      
        Leads::create([
            'client_name'          => $request->client_name,
            'upwork_id'         => $request->upwork_id,
            'job_title'       => $request->job_title,
            'job_url'       => $request->job_url,
            'client_budget' => $request->client_budget,
            'our_estimate'       => $request->our_estimate,
            'bidder_id'       => $request->bidder_id,
            'status'       => $request->status,

        ]);
        

       
        return response()->json([ 'success'=> 'Form is successfully submitted!']);
    

    }

   
        /*==============================================
	                    //  Lead Details Modal
        ============================================*/
    public function view_lead($id){
        $user = user_data();
        $userid = $user->id;
        $leads = Leads::where('id',$id)->get();
        foreach($leads as $lead){
            $bidderid = $lead->bidder_id;
            $upworkid = $lead->upwork_id;
            $leadsid = $lead->id;
        }
       
      
        $comments = Comments::where('user_id', $leadsid)->orderBy('id', 'DESC')->get();
       
       
        $biddername = Bidder::select('bidder_name')->where('id',$bidderid)->get();
        $upworkname = Upwork_id::select('upwork_id_name')->where('id',$upworkid)->get();
		$view = view("modal.leadviewmodal",compact('leads','biddername','upworkname','comments'))->render();

            return Response::json(array(
                'success'=>true,
                'data'=>$view,
                'status'=>200
                ));

    }

      /*==============================================
	                    //   Edit Lead Modal
        ============================================*/
  

    public function edit_lead($id){


        $user = user_data();
        $userid = $user->id;
        $leads = Leads::where('id',$id)->get();
        foreach($leads as $lead){
            $leadsid = $lead->id;
        }
        
        $bidder = bidder_all();
        $upwork_id = upwork_all();
        $comments = Comments::where('user_id', $leadsid)->orderBy('id', 'DESC')->get();
 
        $view = view("modal.leadeditmodal",compact('leads','bidder','upwork_id','comments'))->render();

            return Response::json(array(
                'success'=>true,
                'data'=>$view,
                'status'=>200
                ));
		

    }
            /*==============================================
	                    //   Update Leads
        ============================================*/
    
    public function update_leads(Request $request, $id){

       
        $this->validate($request, [
            'client_name' => 'required',
            'upwork_id' => 'required',
            'job_title' => 'required',
            'job_url' => 'required',
            'client_budget' => 'required',
            'bidder_id' => 'required',
            'status' => 'required',
            
        ]);
        
   
        $requestData = Leads::find($id);
      
        $requestData->update([
            $requestData->client_name = request('client_name'),
            $requestData->upwork_id   =request('upwork_id'),
            $requestData->job_title   = request('job_title'),
            $requestData->job_url   = request('job_url'),
            $requestData->client_budget  = request('client_budget'),
            $requestData->our_estimate =  request('our_estimate'),
            $requestData->bidder_id    = request('bidder_id'),
            $requestData->status       = request('status'),
       
        ]);
       
        $lead =  $requestData;
        $result = array();
        $result['success'] = true;
        $result['view']  =  view('admin.leads.leadsSingleRow',compact('lead'))->render();
     
        $result['class'] = 'lead_row_'.$lead->id;
        	
        return Response::json($result, 200);

    }

     /*==============================================
	                    // Leads Home Page
        ============================================*/

       

    public function leads(Request $request)
    {
     
        $leads_data = $this->lead_search($request,$pagination=true);
       
		if($leads_data['success']){

            // DB::connection()->enableQueryLog();
         
            // $queries = DB::getQueryLog();
            // dd($queries);
            $bidder = bidder_all();
            $upwork_id = upwork_all();
            $leads  = Leads::all();
            $createdat = Leads::select('created_at')->whereDate('created_at', '<', Carbon::today()->toDateString())->get();
			$leads = $leads_data['leads'];
			$page_number =  $leads_data['current_page'];
			if(empty($page_number))
				$page_number = 1;
			
			if(!is_object($leads)) return $leads;
			if ($request->ajax()) {
				return view('admin.leads.leadsPagination', compact('leads','page_number','bidder','upwork_id','createdat'));
			}
			return view('admin.leads.leads',compact('leads','page_number','bidder','upwork_id','createdat'));	
		}else{
          
			return trim($leads_data['message']);
		}
		
		
	}

     /*==============================================
	                   // Leads Filters

        ============================================*/
    
	public function lead_search($request,$pagination)
	{
		
		$page_number = $request->page;
		$number_of_records =$this->per_page;
		$client_name = $request->client_name;
		$job_title = $request->job_title;
		$upworkid = $request->upwork_id;
		$status = $request->status;
		$start_date = $request->start_date;
		$end_date = $request->end_date;
		$bidderid = $request->bidder_id ;
		$custom = $request->custom_filter;
		
      
		$result = Leads::where(`1`, '=', `1`);

                        

		if($client_name!='' || $job_title!='' || $upworkid!='' || $start_date!='' || $end_date!='' || $status!='' || $bidderid !='' || $custom!='' ){
           
			if($start_date!= '' || $end_date!='' ){
				if(empty($end_date))
					$end_date = date('Y-m-d');
				
				if((($start_date!= '' && $end_date=='') || ($start_date== '' && $end_date!='') || ($custom!='' && $custom=='')) || (strtotime($start_date) >= strtotime($end_date))){	
					
					$data = array();
                   
					$data['success'] = false;
					$data['message'] = "date_error";
					return $data; 

                  
				}
			}			
			
			$start_date_c = date('Y-m-d',strtotime($start_date));
			$end_date_c= date('Y-m-d',strtotime($end_date));
            
			if(!empty($start_date) &&  !empty($end_date)){
				$result->where(function($q) use ($start_date_c,$end_date_c) {
				$q->whereDate('created_at','>=' ,$start_date_c);
				$q->whereDate('created_at','<=', $end_date_c );
			  });
			} 
            
                // Current Week Filters
            if($custom == 'current_week') {
           
                $result->where(function($q)  {
                    $q->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
                });
            }
                    //Last Week Filters
            if($custom == 'last_week') {
           
                $result->where(function($q)  {
                    $q->whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(),Carbon::now()->subWeek()->endOfWeek()])->take(100)->get();
                });
               
              
            }
                // Current Month Filters
            if($custom == 'current_month') {
           
                $result->where(function($q)  {
                    $q->whereMonth('created_at', Carbon::now()->month)
                    ->get();
                });
            }
                    //   Last Month Filters
            if($custom == 'last_month') {

                $result->where(function($q)  {
                    $q->whereBetween('created_at',[Carbon::now()->subMonth()->startOfMonth()->toDateString()
                    ,Carbon::now()->subMonth()->endOfMonth()->toDateString()])->get();
                });
            }

           	
			
			
			
			$client_name_s = '%' . $client_name . '%';
			$job_title_s = '%' . $job_title . '%';
			
			
			    // check name 
			if(isset($client_name) && !empty($client_name)){
				$result->where('client_name','LIKE',$client_name_s);
			}
                    // Job Title
			if(isset($job_title) && !empty($job_title)){
				$result->where('job_title','LIKE',$job_title_s);
			}
                    // Upwork ID
		 	if(isset($upworkid) && !empty($upworkid)){
				$result->where('upwork_id','=',$upworkid);
			}
                // Satus Filter
		 	if(isset($status) && !empty($status)){
				$result->where('status','=',$status);
			} 
                    // BIdder ID
            if(isset($bidderid) && !empty($bidderid)){
				$result->where('bidder_id',$bidderid);
			} 
		}
					
		
		if($pagination == true){
			$leads = $result->orderBy('created_at', 'desc')->paginate($number_of_records);
		}else{
			$leads = $result->orderBy('created_at', 'desc')->get();
		}
		
		
		$data = array();
		$data['success'] = true;
		$data['leads'] = $leads;
		$data['current_page'] = $page_number;
		return $data;
	}



   
        /*==============================================
	                   // ADD Comment Modal
        ============================================*/
    public function add_comment_modal($id){
        $leads = Leads::where('id',$id)->get();
        foreach($leads as $lead){
            $leadsid = $lead->id;
        }

        // dd($leadsid);
        $view = view("modal.leadaddcomment",compact('leads'))->render();

        return Response::json(array(
            'success'=>true,
            'data'=>$view,
            'status'=>200
            ));
    }
    
    
        /*==============================================
	                   // Add Reason Model
        ============================================*/
     public function add_reason_modal($id){
        $leads = Leads::where('id',$id)->get();
        foreach($leads as $lead){
            $leadsid = $lead->id;
        }

        // dd($leadsid);
        $view = view("modal.loststatusreason",compact('leads'))->render();

        return Response::json(array(
            'success'=>true,
            'data'=>$view,
            'status'=>200
            ));
    }


        /*==============================================
	                   // Delete Leads
        ============================================*/

       
        public function delete_leads($id){
            $leads  = Leads::all();
            $delet = DB::table("leads")->delete($id);
           
            return response()->json(['success'=>"Lead Deleted successfully.", 'tr'=>'tr_'.$id]);
    
        }
}
