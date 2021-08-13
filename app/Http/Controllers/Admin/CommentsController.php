<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Response;
use App\Models\Comments;

use App\Models\Bidder;
use App\Models\Leads;
use App\Models\Upwork_id;

class CommentsController extends Controller
{


    
    // Add Comments To Lead

    public function add_comment(request $request){
        // dd(Carbon::now());
      
        $user = user_data();

        $request->validate([
            'comment_content' => 'required',
            // 'lost_lead_reason' => 'required',
            
        ]);
        Comments::create([
            'comment_content'    => $request->comment_content,
            'lost_lead_reason'    => $request->lost_lead_reason,  
            'user_id'    => $request->user_id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            
        ]);
        return response()->json([ 'success'=> 'Form is successfully submitted!']);

    }

    // Edit Comment Leads

    public function edit_comment($id){
        $comments = Comments::where('id',$id)->get();
 
        $view = view("modal.leadeditcommentmodal",compact('comments'))->render();

            return Response::json(array(
                'success'=>true,
                'data'=>$view,
                'status'=>200
                ));
	
    }
    public function update_comment(Request $request, $id){
        
        $this->validate($request, [
             'comment_content' => 'required',
        ]);
      
        
        $requestData = Comments::find($id);
      
        $requestData->update([
            $requestData->comment_content = request('comment_content'),
        ]);

        $user = user_data();
        $userid = $user->id;
        $leads = Leads::where('id',$id)->get();
        foreach($leads as $lead){
            $leadsid = $lead->id;
        }
        
        $bidder = bidder_all();
        $upwork_id = upwork_all();
  
        $comment =  $requestData;
       
        $result = array();
        $result['success'] = true;
        $result['view']  =  view('admin.comments.comments',compact('comment'))->render();
     
        $result['class'] = 'comment_'.$comment->id;
        	
        return Response::json($result, 200);

    }

       
        
    


        
    
}
