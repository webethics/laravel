<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([ 'prefix' => 'admin','middleware' => 'admin','namespace' => 'Admin'], function () {

	

	Route::get('/','AdminController@index');
	
	Route::get('logout', 'AdminController@logout');
	
	Route::post('user/enable-disable',array('uses'=>'UsersController@enableDisableUser'));
	Route::post('user/delete_user/{id}', 'UsersController@delete_user')->name('users.delete');
	
	//Dashboard
	Route::get('dashboard',array('uses'=>'DashboardController@index'));
	
	Route::post('update-profile/{user_id}', 'UsersController@profileUpdate');//UPDATE USER
	Route::post('update-basic-profile/{user_id}', 'UsersController@updateBasicProfile');//UPDATE Basic USER
	Route::post('reset-password/{user_id}', 'UsersController@passwordUpdate');
	//roles
	Route::get('roles',array('uses'=>'RolesController@roles'));
	Route::post('roles/edit/{request_id}', 'RolesController@roles_edit'); //Edit request
	Route::get('role/create/',array('uses'=>'RolesController@role_create')); //Edit User
	Route::post('role/delete_role/{request_id}',array('uses'=>'RolesController@role_delete')); //Edit User
	Route::post('/create-role-permissions/',array('uses'=>'RolesController@role_permission_create')); //Edit User
	Route::post('/update-role-permissions/',array('uses'=>'RolesController@role_permission_update')); //Edit User
	
	Route::post('uploads/logo/{request_id}',array('uses'=>'SettingsController@uploadLogo'));
	Route::post('fetch/logo/{request_id}',array('uses'=>'SettingsController@getLogo'));
	Route::post('delete/logo/{request_id}',array('uses'=>'SettingsController@deleteLogo'));
	
	
	//cms pages
	Route::get('cms-pages',array('uses'=>'CmsController@index'));
	Route::get('cms-pages/edit/{request_id}', 'CmsController@cms_page_edit'); //Edit request
	Route::get('cms-pages/create/',array('uses'=>'CmsController@cms_page_create')); //Edit User
	Route::post('cms-pages/delete_page/{request_id}',array('uses'=>'CmsController@page_delete')); //Edit User
	Route::post('cms-page-new',array('uses'=>'CmsController@cms_page_new')); //Edit User
	Route::post('cms-page-update',array('uses'=>'CmsController@cms_page_update')); //Edit User
	
	//Payment listing 
	Route::get('paymentlisting',array('uses'=>'SubscriptionController@paymentlisting'));
	
	// Global Setting 
	Route::get('settings',array('uses'=>'SettingsController@index'));
	Route::get('site-settings',array('uses'=>'SettingsController@site_settings'));
	Route::post('update/email/{request_id}',array('uses'=>'SettingsController@update_email_settings'));
	Route::post('update/site/{request_id}',array('uses'=>'SettingsController@update_site_settings'));
	
	
	
	//EMAIL TEMPLATE 
	Route::get('emails',array('uses'=>'EmailController@index'));
	Route::get('emails/create',array('uses'=>'EmailController@createEmail'));
	Route::post('emails/save',array('uses'=>'EmailController@saveEmail'));
	Route::get('email/edit/{template_id}',array('uses'=>'EmailController@email_template_edit'));
	Route::post('email/update',array('uses'=>'EmailController@email_template_update'));
	
	
	// customers
	Route::get('customers',array('uses'=>'CustomersController@customers'));
	Route::post('customers',array('uses'=>'CustomersController@customers'));
	Route::post('update-customer/{request_id}', 'CustomersController@update_customer'); //Edit User
	
	
	Route::post('customer/edit/{request_id}', 'CustomersController@customer_edit'); //Edit User
	
	Route::get('customer/create/',array('uses'=>'CustomersController@customer_create')); //Edit User
	Route::post('create-new-customer', 'CustomersController@customer_create_new'); //Edit User
	Route::post('customer/delete_customer/{request_id}',array('uses'=>'CustomersController@customer_delete')); //Edit User
	Route::post('customer/mark_as_district_head/{request_id}',array('uses'=>'CustomersController@mark_as_district_head')); //Edit User
	Route::post('customer/mark_as_state_head/{request_id}',array('uses'=>'CustomersController@mark_as_state_head')); //Edit User
	Route::post('export_customers',array('uses'=>'CustomersController@export_customers')); //Edit User
	
	Route::post('export_users_customers/{id}',array('as'=>'ajax.pagination','uses'=>'UsersController@exportListingCustomers'));
	Route::post('export_users',array('as'=>'ajax.pagination','uses'=>'UsersController@exportUsers'));
	
	Route::get('download-certificate/{request_id}',array('uses'=>'CustomersController@downloadCertificate')); //Edit User
	Route::get('manage-customer/{id}', 'CustomersController@manageCustomer');
	Route::post('customer/view/{request_id}', 'CustomersController@customer_view'); //Edit User
	
	Route::post('confirmModal', 'CommonController@confirmModal');
	
	Route::get('account', 'UsersController@account');
	
	Route::get('logout', 'UsersController@logout');
	
	
	Route::get('listarticles',array('uses'=>'ArticlesController@listarticles'));
	Route::get('articles/edit/{request_id}', 'ArticlesController@article_edit'); //Edit Article
	Route::get('articles/create', 'ArticlesController@article_create'); //Edit Article
	Route::post('article-update', 'ArticlesController@update_article'); //Edit Article
	Route::post('article-create', 'ArticlesController@create_article'); //Edit Article
	Route::post('articles/delete_article/{request_id}',array('uses'=>'ArticlesController@article_delete')); //Edit User
	
	Route::get('listtemplates',array('uses'=>'TemplatesController@listtemplates'));
	Route::post('listtemplates',array('uses'=>'TemplatesController@listtemplates'));
	Route::get('listtemplates-arabic',array('uses'=>'TemplatesController@listtemplates_arabic'));
	Route::post('listtemplates-arabic',array('uses'=>'TemplatesController@listtemplates_arabic'));
	Route::get('templates/edit/{request_id}/{lang}', 'TemplatesController@template_edit'); //Edit Template
	Route::get('templates/create/', 'TemplatesController@template_create'); //Edit Article
	Route::get('templates/arabic-create/', 'TemplatesController@arabic_template_create'); //Edit Article
	Route::post('arabic-template-create', 'TemplatesController@arabic_create_template'); //Edit Article
	Route::post('template-update', 'TemplatesController@update_template'); //Edit Article
	Route::post('template-create', 'TemplatesController@create_template'); //Edit Article
	Route::post('templates/delete_template/{request_id}',array('uses'=>'TemplatesController@template_delete')); //Edit User
	Route::post('templates/sortlist/',array('uses'=>'TemplatesController@sortlist')); //Edit User
	Route::post('export_templates',array('uses'=>'TemplatesController@export_templates')); //Edit User
	Route::post('templates/enable-disable',array('uses'=>'TemplatesController@enableDisable'));
	
	Route::get('listforms',array('uses'=>'FormsController@listforms'));
	Route::post('listforms',array('uses'=>'FormsController@listforms'));
	Route::get('listforms-arabic',array('uses'=>'FormsController@listforms_arabic'));
	Route::post('listforms-arabic',array('uses'=>'FormsController@listforms_arabic'));
	Route::get('forms/edit/{request_id}/{lang}', 'FormsController@form_edit'); //Edit form
	Route::get('forms/create/', 'FormsController@form_create'); //Edit Article
	Route::post('form-update', 'FormsController@update_form'); //Edit Article
	Route::post('form-create', 'FormsController@create_form'); //Edit Article
	Route::post('forms/delete_form/{request_id}',array('uses'=>'FormsController@form_delete')); //Edit User
	Route::post('export_forms',array('uses'=>'FormsController@export_forms')); //Edit User
	Route::post('forms/enable-disable',array('uses'=>'FormsController@enableDisable'));
	Route::post('forms/sortlist/',array('uses'=>'FormsController@sortlist')); //Edit User
	
	Route::get('listinfographics',array('uses'=>'InfographicsController@listinfographics'));
	Route::post('listinfographics',array('uses'=>'InfographicsController@listinfographics'));
	Route::get('listinfographics-arabic',array('uses'=>'InfographicsController@listinfographics_arabic'));
	Route::post('listinfographics-arabic',array('uses'=>'InfographicsController@listinfographics_arabic'));
	Route::get('infographics/edit/{request_id}/{lang}', 'InfographicsController@infographic_edit'); //Edit infographics
	Route::get('infographics/create/', 'InfographicsController@infographic_create'); //Edit Article
	Route::post('infographic-update', 'InfographicsController@update_infographic'); //Edit Article
	Route::post('infographic-create', 'InfographicsController@create_infographic'); //Edit Article
	Route::post('infographics/delete_infographic/{request_id}',array('uses'=>'InfographicsController@infographic_delete')); //Edit User
	Route::post('export_infographics',array('uses'=>'InfographicsController@export_infographics')); //Edit User
	Route::post('infographics/enable-disable',array('uses'=>'InfographicsController@enableDisable'));
	
	Route::post('infographics/sortlist/',array('uses'=>'InfographicsController@sortlist')); //Edit User
	
	Route::get('listplans',array('uses'=>'PlansController@listplans'));
	Route::get('plans/edit/{request_id}', 'PlansController@plan_edit'); //Edit Article
	Route::get('plans/create', 'PlansController@plan_create'); //Edit Article
	Route::post('plan-update', 'PlansController@update_plan'); //Edit Article
	Route::post('plan-create', 'PlansController@create_plan'); //Edit Article
	Route::post('plans/delete_plan/{request_id}',array('uses'=>'PlansController@plan_delete')); //Edit User
	Route::post('plans/delete_feature/{request_id}',array('uses'=>'PlansController@feature_delete')); //Edit User
	Route::get('plans/add_features/{request_id}',array('uses'=>'PlansController@add_features')); //Edit User
	Route::post('add-feature', 'PlansController@add_new_feature'); //Edit Article
	Route::post('plans/enable-disable',array('uses'=>'PlansController@enableDisable'));
	
	
	Route::get('sub-categories/{category}',array('uses'=>'DashboardController@createSubcategory'));
	Route::get('listsubcategories',array('uses'=>'DashboardController@listsubcategory'));
	Route::get('edit-sub-categories/{category}',array('uses'=>'DashboardController@editSubcategory'));
	Route::post('create-subcategory-new',array('uses'=>'DashboardController@createNewSubcategory'));
	Route::post('edit-subcategory',array('uses'=>'DashboardController@editNewSubcategory'));
	
	Route::post('dashboard/delete_subcategory/{request_id}',array('uses'=>'DashboardController@subcategory_delete')); //Edit User

	//Blogs
	Route::get('blogs',array('uses'=>'BlogController@blogs'));
	Route::post('blogs',array('uses'=>'BlogController@blogs'));
	Route::get('blog/create',array('uses'=>'BlogController@create')); //Create category
	Route::post('blog/create', 'BlogController@store'); //Create Category submit
	Route::get('blog/edit/{request_id}', 'BlogController@blog_edit'); //Category Edit
	Route::post('blog/update',array('uses'=>'BlogController@update_blog'));
	Route::post('blog/delete/{request_id}',array('uses'=>'BlogController@blog_delete')); //Delete Category
	Route::post('blog/enable-disable',array('uses'=>'BlogController@enableDisableBlog'));
	Route::post('blog/sortlist',array('uses'=>'BlogController@sortList')); //Sort Category
	Route::get('blog/image_downlad/{request_id}',array('uses'=>'BlogController@downloadImage')); //Download Image
	Route::post('blog_image/delete/{request_id}',array('uses'=>'BlogController@deleteBlogImage')); //Delete Image
	Route::post('blog/temp-save-feature-media',array('uses'=>'BlogController@tempSaveFeatureMedia'));
	Route::post('blog/fetch_blog_image',array('uses'=>'BlogController@fetchImage'));

	//Blogs category

	Route::get('blog-categories',array('uses'=>'BlogController@blogsCategories'));
	Route::get('blog-categories/create',array('uses'=>'BlogController@createBlogsCategories')); //Create category
	Route::post('blog-categories/save', 'BlogController@storeBlogsCategories'); //Create Category submit
	Route::get('blog-categories/edit/{request_id}', 'BlogController@editBlogsCategories'); //Category Edit
	Route::post('blog-categories/update',array('uses'=>'BlogController@updateBlogsCategories'));
	Route::post('blog-categories/delete/{request_id}',array('uses'=>'BlogController@deleteBlogsCategories')); //Delete Category
	
	//Auction
	Route::get('auctions',array('uses'=>'AuctionsController@auction'));
	Route::post('auctions',array('uses'=>'AuctionsController@auction'));
	Route::get('auctions/create',array('uses'=>'AuctionsController@create'));
	Route::post('auctions/create',array('uses'=>'AuctionsController@store'));
	Route::get('auctions/edit/{request_id}',array('uses'=>'AuctionsController@auction_edit'));
	Route::post('auctions/update',array('uses'=>'AuctionsController@auction_update'));
	Route::post('auctions/delete_game/{request_id}',array('uses'=>'AuctionsController@delete_auction'));
	Route::post('auctions/enable-disable',array('uses'=>'AuctionsController@enableDisableAuction'));
	Route::get('auctions/image_downlad/{request_id}/{media_id?}',array('uses'=>'AuctionsController@downloadFeatureImage')); //Download Image
	Route::post('auction_image/delete/{request_id}',array('uses'=>'AuctionsController@deleteAuctionImage')); //Delete Image

	//upload Temp media
	Route::post('auctions/temp-save-media',array('uses'=>'AuctionsController@tempSaveMedia'));
	Route::post('auctions/temp-save-feature-media',array('uses'=>'AuctionsController@tempSaveFeatureMedia'));
	Route::post('auctions/fetch_auction_image',array('uses'=>'AuctionsController@fetchAuctionImages'));
	Route::post('auctions/remove_auction_image',array('uses'=>'AuctionsController@remove_auction_image'));
});	

Route::group(['prefix' => 'admin','namespace' => 'Admin'], function () {
	Route::post('checklogin','AdminController@checklogin');
	Route::post('sendpasswordemail','AdminController@sendpasswordemail');
	Route::get('/login', 'AdminController@login');
	Route::get('/forgot-password', 'AdminController@forgot_password');
	Route::get('/password/reset/{token}', 'AdminController@reset_password');
	Route::post('/password-reset', 'AdminController@reset');
	// Route::get('forgotpassword', 'AdminController@forgotpassword');

});