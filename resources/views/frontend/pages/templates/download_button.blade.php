<?php 
	$cpayment = checkpayments();
	$user = Auth::user();
	if($template->is_protected == 1){
			
			if($cpayment && $cpayment['expirystatus'] == 1 && $cpayment['subscription_id'] != "" && $cpayment['user_id'] == $user->id){
				if($template->editableFile != ""){ ?>
					<a data-edit="<?php echo "dedit"; ?>" data-infoid="<?php echo $template->id; ?>" data-user_id="<?php echo $user->id; ?>" href="<?php echo url('uploads/templates/editable/'.$template->editableFile); ?>" download class="downloadedit modal-trigger btn btn-new">{{trans('common.download-edit')}}</a>
			<?php } ?>
			<a data-edit="<?php echo "dpdf"; ?>" data-infoid="<?php echo $template->id; ?>" data-user_id="<?php echo $user->id; ?>" href="<?php echo url('uploads/templates/'.$template->files); ?>" download class="downloadpdf modal-trigger btn btn-grey">{{trans('common.download-pdf')}}</a>
		<?php }else{ 
				if(!$user){ ?>
					<!--a data-toggle="modal" id="dweditbutton"  data-target="#signinmodal" href="javascript:void(0)" class="downloadedit modal-trigger btn btn-new">{{trans('common.download-edit')}}</a>
					<a data-toggle="modal" id="dwpdfbutton"  data-target="#signinmodal" href="javascript:void(0)" class="downloadpdf get_access_btn modal-trigger full_access_btn btn btn-grey">{{trans('common.download-pdf')}}</a-->
					<a id="dwpdfbutton" href="{{url('/all-plans')}}" class="downloadpdf get_access_btn full_access_btn btn btn-grey ">{{trans('common.get-access')}}</a>
				<?php }else{ ?>
					<a href="{{url('/subscription')}}" class="downloadedit modal-trigger btn btn-new">{{trans('common.get-access')}}</a>
					<!--a href="{{url('/subscription')}}" class="downloadpdf modal-trigger get_access_btn full_access_btn btn">{{trans('common.download-pdf')}}</a-->
				<?php }
			} ?>
<?php }else{ ?>

<?php 
		if($template->editableFile != ""){ 
			$user = Auth::user();
				if($user){

		?>
				<a data-edit="<?php echo "dedit"; ?>" data-infoid="<?php echo $template->id; ?>" data-user_id="<?php echo $user->id; ?>" href="<?php echo url('uploads/templates/editable/'.$template->editableFile); ?>" download class="btn btn-new downloadedit">
	<?php }else{ ?>
				<a data-toggle="modal" id="dweditbutton"  data-target="#signinmodal" href="javascript:void(0)" class="downloadedit modal-trigger btn btn-new">
		<?php } ?>{{trans('common.download-edit')}}</a>
		<?php } ?>
		<?php $user = Auth::user();
				if($user){
					?>
					<a data-edit="<?php echo "dpdf"; ?>" data-infoid="<?php echo $template->id; ?>" data-user_id="<?php echo $user->id; ?>" href="<?php echo url('uploads/templates/'.$template->files); ?>" download class="downloadpdf modal-trigger btn btn-grey">
		   <?php }else{ ?>
					<a data-toggle="modal"  id="dwpdfbutton"  data-target="#signinmodal" href="javascript:void(0)" class="downloadpdf modal-trigger btn btn-grey">
		<?php } ?>
			
		{{trans('common.download-pdf')}}</a>
<?php } ?> 