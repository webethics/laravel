
							
							<div class="w-100"></div>
								<div class="col-md-12 ml-auto comment_{{$comment->id}}" id="comment_box_2">   
									<div class="py-3 px-4 mt-3 custom-comment bg-light recieve_msg" id="comment_box_leads">
										<p> {{$comment->lost_lead_reason}} </p>
										<p  id="comment_24_leads" class="mb-1 comments_{{$comment->id}}" >{{$comment->comment_content}}</p>
										@php 
										$user = user_data()
										@endphp 
									
										<div class="row">
												<div class="col-md-6">
												<p class="mb-1 user"><b style="font-size: 13px;">{{ $user->first_name}} {{ $user->last_name}}</b></p>
												</div>
												<div class="col-md-1">
												<a class="action2 editcomment" href="javascript:void(0)" data-comment_id="{{$comment->id}}" title="Edit Comment" ><i class="simple-icon-note"></i> </a>
												</div>
										</div>

											
										<p class="mb-1 time">{{viewTimeFormat($comment->created_at)}}</p>
									
										
									</div>
									
								</div>
								
	
							