
		 
<tr data-lead-id="{{$lead->id}}"  class="lead_row_{{$lead->id}}" >
                    <!-- Created At Date -->
    <td style="margin-top:10px;" >{{viewDateFormat($lead->created_at)}}</td>
                <!-- Upwork ID name -->
    <td><a href="#">
  
    {{\App\Models\Upwork_id::where(['id' => $lead->upwork_id])->first()->upwork_id_name}}
								
	</a></td>
     <!-- Bidder ID -->
     <td><a href="#">
  
        {{\App\Models\Bidder::where(['id' => $lead->bidder_id])->first()->bidder_name}}
                                    
     </a></td>
                <!-- Job Title -->
    <td  id="job_title_{{$lead->id}}"><a href="#">
      
        <div class="tooltips" > {{ \Illuminate\Support\Str::limit($lead->job_title,20) }}
        <span class="tooltiptext">{{$lead->job_title}}</span>
        </div></a>
    </td>
           

                <!-- Client Budget -->
    <td  id="our_estimate_{{$lead->id}}">{{$lead->client_budget}}</td>
                    <!-- Client Name -->
   
	<td id="client_name_{{$lead->id}}">{{$lead->client_name}}</td>
 
                    <!-- Status -->
    <td  id="status_{{$lead->id}}">
   
    @if($lead->status == 1 && \Carbon\Carbon::parse($lead->created_at)->subDays(30)->format('m') < now()->subDays(30)->format('m'))

    <a href="#"><div class="bg-primary bg-lg text-light leadstatus" > Action Needed </div> </a>     

    @else
   

    @if($lead->status == 1)
    <a href="#"><div class="bg-warning bg-lg text-light leadstatus" > Active </div> </a>
    @elseif($lead->status == 2)
    <a href="#"><div class="bg-success text-light  leadstatus"> Hired </div></a>
    @elseif($lead->status == 3)
    
    <a href="#"><div class="bg-danger text-light leadstatus"> Lost </div></a>
    @elseif($lead->status == 4)
    
    <a href="#"><div class="bg-secondary text-light leadstatus"> Unresponsive </div></a>
    @endif

    @endif
   
    </td>
    <td>
		<!-- Edit Lead -->
        <a class="action2 leadEdit" title="Edit Lead" data-lead_id="{{$lead->id}}" href="javascript:void(0)" ><i class="simple-icon-note"  ></i> </a>

                
			<!-- View Lead -->
            <a class="action2 leadview" data-lead_id="{{$lead->id}}" title="View Lead" href="javascript:void(0)"><i class="simple-icon-eye"  > </i></a>

			

					<!-- Delete Lead -->
        <a title="Delete Lead" data-id="{{$lead->id}}" data-confirm_type="complete" data-confirm_message="Are you sure you want to delete the Lead?" data-left_button_name="Yes" data-left_button_id="delete_lead" data-left_button_cls="btn-primary" class="open_confirmBox action2 deleteLead" href="{{url('admin/leads/deleteleads/'.$lead->id)}}" data-lead_id="{{ $lead->id }}"><i class="simple-icon-trash"></i></a>



      
        
    </td>
  
</tr>


