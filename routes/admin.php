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
	// Route::post('export_users',array('as'=>'ajax.pagination','uses'=>'UsersController@exportUsers'));
	
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
	
	
	
	
	Route::get('sub-categories/{category}',array('uses'=>'DashboardController@createSubcategory'));
	Route::get('listsubcategories',array('uses'=>'DashboardController@listsubcategory'));
	Route::get('edit-sub-categories/{category}',array('uses'=>'DashboardController@editSubcategory'));
	Route::post('create-subcategory-new',array('uses'=>'DashboardController@createNewSubcategory'));
	Route::post('edit-subcategory',array('uses'=>'DashboardController@editNewSubcategory'));
	
	Route::post('dashboard/delete_subcategory/{request_id}',array('uses'=>'DashboardController@subcategory_delete')); //Edit User

	
	
	
	
});	

Route::group(['namespace' => 'Admin'], function () {
Route::get('/', 'AdminController@login');
});

Route::group(['prefix' => 'admin','namespace' => 'Admin'], function () {
	Route::post('checklogin','AdminController@checklogin');
	Route::post('sendpasswordemail','AdminController@sendpasswordemail');

	Route::get('/forgot-password', 'AdminController@forgot_password');
	Route::get('/password/reset/{token}', 'AdminController@reset_password');
	Route::post('/password-reset', 'AdminController@reset');
	// Route::get('forgotpassword', 'AdminController@forgotpassword');

});

// Leads Controller

	Route::get('admin/leads', 'Admin\LeadsController@leads');
	Route::post('admin/store', 'Admin\LeadsController@store');

	Route::post('admin/leads/update/{request_id}', 'Admin\LeadsController@update_leads');
	Route::post('admin/lead/view/{request_id}', 'Admin\LeadsController@view_lead');
	Route::post('admin/lead/edit/{id}', 'Admin\LeadsController@edit_lead');
	Route::post('admin/leads/delete/{request_id}', 'Admin\LeadsController@delete_leads');
	Route::get('searchleads', 'Admin\LeadsController@leads_Search');
	// Route::get('searchleads', 'Admin\LeadsController@add_comment_modal');
	Route::post('admin/addcommentview/{id}', 'Admin\LeadsController@add_comment_modal');
	Route::post('admin/addreasonmodal/{id}', 'Admin\LeadsController@add_reason_modal');

	
// Leads Comments Controller
	Route::post('admin/comment', 'Admin\CommentsController@add_comment');
	Route::post('admin/editcomment/{id}', 'Admin\CommentsController@edit_comment');
	Route::post('admin/updatecomment/{id}', 'Admin\CommentsController@update_comment');

	Route::post('admin/leadlostreason', 'Admin\CommentsController@add_reason');
// HR Controlller

	Route::get('admin/hrpanel', 'Admin\HrMenuController@loadview');
	Route::get('admin/edit', 'Admin\HrMenuController@edit');
	Route::get('admin/add', 'Admin\HrMenuController@add');
	Route::post('admin/store/employee', 'Admin\HrMenuController@add_employee');
	Route::post('admin/store/hr', 'Admin\HrMenuController@add_hr');
	Route::post('admin/hrpanel/view/{request_id}', 'Admin\HrMenuController@view_hr');
	Route::post('admin/employee/delete/{request_id}', 'Admin\HrMenuController@delete_employee');
	Route::get('admin/employee/edit/{id}', 'Admin\HrMenuController@edit_employee');

// Bugs Controller

	Route::get('admin/bugs', 'Admin\BugsController@loadview');

	

