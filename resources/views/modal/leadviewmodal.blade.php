<style>


*[tooltip]:focus:after {
  content: attr(tooltip);
  display:block;
  position: absolute;    
  background-color: black;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
 
    z-index: 1;
    width: 80px;
    bottom: 
    left: 50%;
    margin-left: 50px ;
    margin-bottom:70px;	
   
}


</style>
<div class="modal-dialog" role="document">
	<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
						
							</div>
						
							@foreach($leads as $lead)
							<p id="demo" style="display:none;">{{$lead->job_url}}</p>
							<div class="modal-body">
								
							<!-- Comment Content -->
								<p style="font-size: .85rem;line-height: 1.2rem;font-family: Nunito,sans-serif"><strong>Client Name : </strong>{{$lead->client_name}}</p>

								<!-- Upwork ID -->
								@foreach($upworkname as $u)
								<p style="font-size: .85rem;line-height: 1.2rem;font-family: Nunito,sans-serif"><strong>Upwork Account : </strong>{{$u->upwork_id_name}}</p>
								@endforeach
								<!-- Job Title -->


									
								
								<p class="tooltips" style="font-size: .85rem;line-height: 1.2rem;font-family: Nunito,sans-serif"><strong>Title : </strong>{{ \Illuminate\Support\Str::limit($lead->job_title,5) }}</p>

									<!-- Job URL -->
								<p style="font-size: .85rem;line-height: 1.2rem;font-family: Nunito,sans-serif" class="urltooltip"><strong >Job URL</strong> <a href = "javascript:void(0)" onclick="copy('#demo')" tooltip="Copied" > : Copy </a>
								</p>   
							
								
										<!-- our_estimate -->
										@if($lead->our_estimate=="")
								<p style="font-size: .85rem;line-height: 1.2rem;font-family: Nunito,sans-serif"><strong>Client Estimate : </strong>	NULL</p>

									@else
								<p style="font-size: .85rem;line-height: 1.2rem;font-family: Nunito,sans-serif"><strong>Our Estimate : </strong>{{$lead->our_estimate}}</p>
								@endif
											<!-- Client Budget -->
								<p style="font-size: .85rem;line-height: 1.2rem;font-family: Nunito,sans-serif"><strong>Client Budget : </strong>{{$lead->client_budget}}</p>
								<!-- Bidder Name -->
								@foreach($biddername as $b)

								<p style="font-size: .85rem;line-height: 1.2rem;font-family: Nunito,sans-serif"><strong>Bidder Name : </strong>{{$b->bidder_name}}</p>

								@endforeach

									<!-- Our Estimate -->
								@if($lead->status == 1)
								<p style="font-size: .85rem;line-height: 1.2rem;font-family: Nunito,sans-serif"><strong>Status : </strong>Active</p>
								@elseif($lead->status == 2)
								<p style="font-size: .85rem;line-height: 1.2rem;font-family: Nunito,sans-serif"><strong>Status : </strong>Hired</p>
								@elseif($lead->status == 3)
								<p style="font-size: .85rem;line-height: 1.2rem;font-family: Nunito,sans-serif"><strong>Status : </strong>Lost</p>
								@elseif($lead->status == 4)
								
								<p style="font-size: .85rem;line-height: 1.2rem;font-family: Nunito,sans-serif"><strong>Status : </strong>Unresponsive</p>
								

								@endif

										
									<!-- Add Comment -->
								<a href="#" data-toggle="modal" data-target="#AddComment"  style="margin-left: 169px;font-weight: bolder;" onMouseOver="this.style.color='#f9633e'" data-dismiss="modal"  onMouseOut="this.style.color='#3934d8'"> Add Comment</a>
							

								<!-- View Comments -->
								<div class="commentdiv">
									@foreach($comments as $key => $comment)
									
									@include('admin.comments.comments')
									
									@endforeach
								</div>		
								<!-- Close Button -->
								<button type="submit" class="btn btn-dark default btn-lg mt-5 mb-sm-0 mr-2 col-12 col-sm-auto closebutton" data-dismiss="modal">Close</button>
							
							</div>
							@endforeach
						
	</div>	

</div>
<script>
function copy(selector){
	$("tooltiptext").show();
  var $temp = $("<div>");
  $("body").append($temp);
  $temp.attr("contenteditable", true)
       .html($(selector).html()).select()
       .on("focus", function() { document.execCommand('selectAll',false,null); })
       .focus();
  document.execCommand("copy");
 

  $temp.remove();
}


// copies tooltip

$('#loststatus').on('hide.bs.modal', function(e){
var reason = $('#reason_for_lost').val();
  if( reason == "" ) {
     e.preventDefault();
     e.stopImmediatePropagation();
   	 return false; 
   }    
});
</script>	