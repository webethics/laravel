<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmployeeCategory;
use Illuminate\Http\Request;
use App\Models\Leads;
use App\Models\Hrmenu;
use App\Models\HRtab;
use Carbon\Carbon;
use Response;
use DB;



class HrMenuController extends Controller
{
   public function loadview(){

    $employees = Hrmenu::all();
   
    return view('admin.HR.HR',compact('employees'));

   }


   public function edit(){
      return view('admin.HR.HREditEmployeeForm');
  
     }
     public function add(){
        $category = EmployeeCategory::all();
      return view('admin.HR.Add',compact('category'));
  
     }


     public function view_hr($id){
       
        $employees = Hrmenu::where('id',$id)->get();
        
		$view = view("modal.viewemployeemodal",compact('employees'))->render();

            return Response::json(array(
                'success'=>true,
                'data'=>$view,
                'status'=>200
                ));

    }

     public function add_employee(Request $request){

            $request->validate([
                'emp_id'   => 'required',
                'emp_name'   => 'required',
                'father_name'  => 'required',
                'personal_email'  => 'required',
                'phone' => 'required',
                'date_of_joining'  => 'required',
                'date_of_birth' => 'required', 
                'current_salary'  => 'required',
                'category'  => 'required',
                'esi_details'  => 'required',
    
            ]);
            $date_of_joining   = Carbon::parse($request->date_of_joining)->format('y-m-d');
            $date_of_birth   = Carbon::parse($request->date_of_birth)->format('y-m-d');
            
            Hrmenu::create([
                'emp_id'          => $request->emp_id,
                'emp_name'          => $request->emp_name,
                'father_name'         => $request->father_name,
                'personal_email'       => $request->personal_email,
                'professional_email'       => $request->professional_email,
                'phone'                 => $request->phone,
                'current_address'       => $request->current_address,
                'permanent_address'       => $request->permanent_address,
                'date_of_joining'       =>  $date_of_joining,
                'date_of_birth'       =>   $date_of_birth ,
                'current_salary'       => $request->current_salary,
                'category'       => $request->category,
                'pan_details'       => $request->pan_details,
                'epfo_details'       => $request->epfo_details,
                'esi_details'       => $request->esi_details,
                'bank_account'       => $request->esi_details,
                'ifsc_code'  => $request->ifsc_code,

            ]);
            return response()->json([ 'success'=> 'Form is successfully submitted!']);

     }


     public function edit_employee($id){

        $categories = EmployeeCategory::all();
        $employees = Hrmenu::where('id',$id)->get();
       
       return view("admin.HR.HREditEmployeeForm",compact('employees','categories'));


     }




     public function update_employee(Request $request){

        $request->validate([
            'emp_id'   => 'required',
            'emp_name'   => 'required',
            'father_name'  => 'required',
            'personal_email'  => 'required',
            'phone' => 'required',
            'date_of_joining'  => 'required',
            'date_of_birth' => 'required', 
            'current_salary'  => 'required',
            'category'  => 'required',
            'esi_details'  => 'required',

        ]);

        $requestData = Hrmenu::find($id);

        $date_of_joining   = Carbon::parse($request->date_of_joining)->format('y-m-d');
        $date_of_birth   = Carbon::parse($request->date_of_birth)->format('y-m-d');

        $requestData->update([
            $requestData->emp_id = request('emp_id'),
            $requestData->emp_name   =request('emp_name'),
            $requestData->father_name   = request('father_name'),
            $requestData->personal_email   = request('personal_email'),
            $requestData->professional_email  = request('professional_email'),
            $requestData->phone =  request('phone'),
            $requestData->current_address    = request('current_address'),
            $requestData->permanent_address       = request('permanent_address'),
            $date_of_joining                 = request('date_of_joining'),
            $date_of_birth                   = request('date_of_birth'),
            $requestData->current_salary       = request('current_salary'),
            $requestData->category       = request('category'),
            $requestData->pan_details       = request('pan_details'),
            $requestData->epfo_details       = request('epfo_details'),
            $requestData->esi_details       = request('esi_details'),
            $requestData->bank_account       = request('bank_account'),
            $requestData->ifsc_code       = request('ifsc_code'),
       
        ]);
       
        $lead =  $requestData;
        $result = array();
        $result['success'] = true;
        $result['view']  =  view('admin.leads.leadsSingleRow',compact('lead'))->render();
     
        $result['class'] = 'lead_row_'.$lead->id;
        	
        return Response::json($result, 200);



      
        
    

    }

     public function add_documents(Request $request){

        $file = $request->file('file');
        $avatarName = $image->getClientOriginalName();
        $image->move(public_path('uploaded_files'),$avatarName);
         
        $imageUpload = new Image();
        $imageUpload->title = $avatarName;
        $imageUpload->save();
        return response()->json(['success'=>$avatarName]);



     }



    public function add_hr(Request $request){

        $request->validate([


            'hired_on'  => 'required',
            'increment_due'  => 'required',
          

        ]);
        $leaving_date   = Carbon::parse($request->leaving_date)->format('y-m-d');
        $increment_due   = Carbon::parse($request->increment_due)->format('y-m-d');
      
        HRtab::create([
            'tech_stack'          =>   implode(',',  $request->tech_stack),
            'past_experience'          => $request->past_experience,
            'past_companies'         => $request->past_companies,
            'tele_verification'       => $request->tele_verification,
            'email_verification'       => $request->email_verification,
            'hired_through'                 => $request->hired_through,
            'hired_on'                  => $request->hired_on,
            'increment_due'       =>  $increment_due,
            'leaving_date'       =>  $leaving_date,
            'education'       => $request->education,
            'comments'       => $request->comments,
            

        ]);
        return response()->json([ 'success'=> 'Form is successfully submitted!']);

    }


    public function delete_employee($id){
    $employeeid =  Hrmenu::find($id);
    
    $employeeid->delete();

    return response()->json(['success'=>"Employee Deleted successfully."]);
    
    }  

   

}