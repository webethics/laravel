<!-- Modal -->
<div id="forget_modal" class="modal fade" role="dialog">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{trans('authentications.forgotpassword.restore')}}</h4>
      </div>
	  <form method="POST" action="{{ route('login') }}" class="frm_class">
		 {{ csrf_field() }}
      <div class="modal-body">
        <p>{{trans('authentications.forgotpassword.restore_message')}}</p>
        <input class="form-control" type="email" name="email" id="email" placeholder="{{trans('authentications.forgotpassword.email')}}" required="">
		<div class="error_margin"><span class="email_error error" ></span></div>
		
      </div>
	 
      <div class="modal-footer">
        <button type="button" class="btn btn-default clear" >{{trans('authentications.forgotpassword.cancel')}}</button>
        <button type="button" class="btn btn-default" id="sendForget"><i class="fa fa-spinner fa-spin request_loader" style="display:none"></i> {{trans('authentications.forgotpassword.send')}} </button>
      </div>
	   </form>
    </div>
  </div>
</div>	