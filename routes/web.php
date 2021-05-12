<?php

Route::get('/', 'User\HomeController@home_page');
Route::get('/faq', 'User\HomeController@faq');
Route::get('/login', 'User\HomeController@home_page');
Route::get('/contact-us', 'User\HomeController@contact_us');
Route::post('contact-submit','User\HomeController@contact_submit');
Route::get('/about-us', 'User\HomeController@about_us');
Route::get('/terms-conditions', 'User\HomeController@terms_conditions');
Route::get('/infographics', 'User\InfographicsController@index');
Route::get('/privacy-policy', 'User\HomeController@privacy_policy');
Route::get('/cookie-policy', 'User\HomeController@cookie_policy');
Route::get('/help', 'User\HomeController@help');
Route::get('/documentation', 'User\HomeController@documentation');
Route::get('/accessibility', 'User\HomeController@accessibility');

Route::get('user-profile', 'User\UsersController@editProfile'); 
Route::get('subscription', 'User\UsersController@userSubscription'); 
Route::get('all-plans', 'User\HomeController@allPlans'); 



Route::get('/articles', 'User\ArticlesController@index');
Route::get('/infographics', 'User\InfographicsController@index');
Route::get('/slides', 'User\TemplatesController@index');
Route::get('/forms', 'User\FormsController@index');
Route::post('/getSingleFormData/{form_id}', 'User\FormsController@getSingleForm');
Route::post('/getSingleInfoData/{form_id}', 'User\InfographicsController@getSingleForm');
Route::post('/getSingleTemplateData/{template_id}', 'User\TemplatesController@getSingleTemplate');

Route::get('slide-details/{template_id}/{lang}', 'User\TemplatesController@template_details');
Route::get('form-details/{form_id}/{lang}', 'User\FormsController@form_details');
Route::get('infographic-details/{infographic_id}/{lang}', 'User\InfographicsController@infographic_details');

Route::get('infographic-details-test/{infographic_id}/{lang}', 'User\InfographicsController@infographic_details_test');
Route::get('slide-details-test/{template_id}/{lang}', 'User\TemplatesController@template_details_test');
Route::get('form-details-test/{form_id}/{lang}', 'User\FormsController@form_details_test');



Route::post('/SearchAutoCompletetemp1', 'User\TemplatesController@searchTemplate');
Route::post('/SearchAutoCompleteinfo1', 'User\InfographicsController@searchTemplate');
Route::post('/SearchAutoCompleteform1', 'User\FormsController@searchTemplate');

Route::post('/infographics/get_info_from_slug', 'User\InfographicsController@getSlugInfo');
Route::post('/slides/get_info_from_slug', 'User\TemplatesController@getSlugInfo');
Route::post('/forms/get_info_from_slug', 'User\FormsController@getSlugInfo');
Auth::routes(['login' => true]);
Auth::routes(['register' => true]);

Route::get('/changelanguage/{locale}', 'User\UsersController@changelanguage');

	Route::get('/redirect/{role}', 'SocialAuthFacebookController@redirect');
    Route::get('/callback', 'SocialAuthFacebookController@callback');
	
	//GOOGLE LOGIN 
	Route::get('/redirectg/{role}', 'SocialAuthGoogleController@redirect');
	Route::get('/callbackg', 'SocialAuthGoogleController@callback');
	
	
	
Route::group(['prefix' => '','as' => 'user.' ,'namespace' => 'User','middleware' => ['auth']], function () {
    //FACEBOOK LOGIN 
	Route::post('user/enable-disable',array('uses'=>'UsersController@enableDisableUser'));
	/* //GOOGLE LOGIN 
	Route::get('/redirectg/{role}', 'SocialAuthGoogleController@redirect');
	Route::get('/callbackg', 'SocialAuthGoogleController@callback');
	
	//TWITTER  LOGIN 
	Route::get('/twitter/redirect/{role}', 'SocialAuthTwitterController@redirect');
	Route::get('twitter/callback', 'SocialAuthTwitterController@callback'); */
	
	Route::get('pdfview','UsersController@pdfview');
	
	Route::get('user-profile', 'UsersController@editProfile'); 
	Route::get('edit-profile', 'UsersController@editProfile'); 
	Route::get('logout', 'UsersController@logout');
	Route::get('subscription', 'UsersController@userSubscription'); 
	Route::get('payment/{plan_id}', 'UsersController@userPayment'); 
	
	Route::get('foloosiPayment/{plan_id}', 'UsersController@userFoloosiPayment'); 
	

	Route::get('downloads', 'UsersController@userDownloads'); 
	
	Route::post('update-profile', 'UsersController@UpdateEditProfile')->name('update-profile'); 
	 Route::post('changepassword', 'UsersController@passwordUpdate'); 
	Route::post('upload_profile_photo', 'UsersController@uploadProfilePhoto'); 
	Route::post('upload_banner_photo', 'UsersController@uploadBannerPhoto');
	Route::post('saveSubscriptionData', 'UsersController@saveSubscriptionData');
	Route::post('saveFoloosiSubscriptionData', 'UsersController@saveFoloosiSubscriptionData');
	Route::post('update-plan','UsersController@updatePlan');
	 Route::post('openCancelSubscriptionModal', 'UsersController@openCancelSubscriptionModal'); 
	Route::post('cancel_subscription', 'UsersController@cancelSubscription'); 
	
	Route::post('update_preview_count', 'InfographicsController@updatePreviewCount'); 
	Route::post('update_dpdf_count', 'InfographicsController@updateDpdfCount'); 
	Route::post('update_depdf_count', 'InfographicsController@updateDepdfCount'); 
	Route::post('update_shared_count', 'InfographicsController@updatesharecount'); 
	
	Route::post('update_preview_count_temp', 'TemplatesController@updatePreviewCount'); 
	Route::post('update_dpdf_count_temp', 'TemplatesController@updateDpdfCount'); 
	Route::post('update_depdf_count_temp', 'TemplatesController@updateDepdfCount'); 
	Route::post('update_shared_count_temp', 'TemplatesController@updatesharecount'); 
	
	
	Route::post('update_preview_count_form', 'FormsController@updatePreviewCount'); 
	Route::post('update_dpdf_count_form', 'FormsController@updateDpdfCount'); 
	Route::post('update_depdf_count_form', 'FormsController@updateDepdfCount'); 
	Route::post('update_shared_count_form', 'FormsController@updatesharecount'); 
	
	
});



  
  
Route::post('user/cityDropdown', 'User\UsersController@cityDropdown');
Route::post('user/calculateAge', 'User\UsersController@calculateAge');
Route::post('user/verifiedAadhar', 'User\UsersController@verifiedAadhar');
	
	
Route::get('verify/account/{token}', 'Auth\RegisterController@verifyAccount'); //VERIFY ACCOUNT


Route::get('confirmation', 'Auth\RegisterController@Registeration_confirmation'); //REGISTER CONFIRMATION

// Password Reset Routes...
Route::post('send_reset_link', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');

Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
Route::post('password/reset_new_user_password', 'Auth\ResetPasswordController@reset_new_user_password');

Route::any('scheduled-reminder-email', 'User\UsersController@scheduledReminderEmail');


/* Route::get('verify/account/{token}', 'User\UsersController@verifyAccount'); //VERIFY ACCOUNT


// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');

Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
Route::post('password/reset_new_user_password', 'Auth\ResetPasswordController@reset_new_user_password'); */

Route::group(['prefix' => '','as' => 'user.' ,'namespace' => 'User'], function () {
	
	Route::get('blog/{slug}','PagesController@blog_details');
});
