<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test' , function() {
});



Route::get('/', function () {
    return view('auth.login');
//	return view('test');
});

Auth::routes();

Route::get('/home', 'EventsController@view_calendar')->name('home');


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::resource('/permissions' ,'PermissionsController');
Route::resource('/roles' ,'RolesController');
Route::resource('/users' ,'UsersController');
Route::resource('/business_group' ,'BusinessGroupController');
Route::get('/business_group_dashboard/{id}' ,'BusinessGroupController@business_group_dashboard')->name('business_group_dashboard');
Route::post('/business_group_dashboard_search/{id}' ,'BusinessGroupController@business_group_dashboard_search')->name('business_group_dashboard_search');

Route::post('/filter_business_groups_report_by_quater/{id}' ,'BusinessGroupController@filter_business_groups_report_by_quater')->name('filter_business_groups_report_by_quater');
Route::resource('/business_owner' ,'BusinessOwnerController');

///////////////////////////////////////////////////Business Sites//////////////////////////////////////////////////////////////
Route::resource('/business_sites' ,'SiteController');
Route::get('/site_report/{id}' , 'SiteController@reports')->name('site_report');
Route::post('/site_search/{id}' , 'SiteController@site_search')->name('site_search');

Route::post('/site_search_by_quater/{id}' , 'SiteController@site_search_by_quater')->name('site_search_by_quater');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///
Route::resource('/visitations' ,'VisitationsController');
Route::get('/create_visitation/{id}' ,'VisitationsController@create_visitation')->name('create_visitation');
Route::post('/store_visitation/{id}' ,'VisitationsController@store_visitation')->name('store_visitation');
Route::get('/visitations_list/{id}' ,'VisitationsController@visitations_list')->name('visitations_list');
Route::get('/visitations_detail/{id}' ,'VisitationsController@visitations_detail')->name('visitations_detail');

//////////////////////////////////////////////SOH////////////////////////////////////////////////////////////////////////////
Route::get('soh_list/{id}' , 'SOHController@soh_list')->name('soh_list');
Route::get('/capture_soh/{id}' , 'SOHController@capture_soh')->name('capture_soh');
Route::get('/edit_soh/{id}/{site_id}' , 'SOHController@edit_soh')->name('edit_soh');
Route::post('/store_soh/{id}' , 'SOHController@store_soh')->name('store_soh');
Route::post('/update_soh/{id}/{site_id}' , 'SOHController@update_soh')->name('update_soh');

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////Quantity Sold///////////////////////////////////////////////////////////////////
Route::get('/capture_quantity_sold_list/{id}' , 'QuantitySoldController@capture_quantity_sold_list')->name('capture_quantity_sold_list');
Route::get('/capture_quantity_sold/{id}' , 'QuantitySoldController@capture_quantity_sold')->name('capture_quantity_sold');
Route::get('/edit_quantity_sold/{id}/{site_id}' , 'QuantitySoldController@edit_quantity_sold')->name('edit_quantity_sold');
Route::post('/store_quantity_sold/{id}' , 'QuantitySoldController@store_quantity_sold')->name('store_quantity_sold');
Route::post('/update_quantity_sold/{id}/{site_id}' , 'QuantitySoldController@update_quantity_sold')->name('update_quantity_sold');
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('user_password_resets/{id}' , 'UsersController@reset_password')->name('reset_password');
Route::post('change_password/{id}' , 'UsersController@change_password')->name('change_password');
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////Set Product Price///////////////////////////////////////////////////////////
Route::resource('set_price' , 'PriceController');
/// //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////Excel File Uploads///////////////////////////////////////////////////////////

Route::get('business_owner_upload_view' , 'ExcelFileUploadController@business_owner_upload_view')->name('upload_view');
Route::post('business_owner_upload' , 'ExcelFileUploadController@business_owner_upload')->name('business_owner_upload');

Route::post('/fileexport' , 'FileUploadsController@export')->name('export');
Route::get('/file_export_view' , 'FileUploadsController@file_export_view')->name('file_export_view');

Route::post('franchise_quantities_sold' , 'ExcelFileUploadController@franchise_quantities_sold')->name('franchise_quantities_sold');



Route::get('sites_uploads_view' , 'ExcelFileUploadController@sites_uploads_view')->name('sites_uploads_view');
Route::post('sites_uploads_uploads' , 'ExcelFileUploadController@sites_uploads_uploads')->name('sites_uploads_uploads');

//Route::post('franchise_quantities_sold' , 'ExcelFileUploadController@franchise_quantities_sold')->name('franchise_quantities_sold');

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////Events Routes//////////////////////////////////////////////////////////////
Route::resource('events' , 'EventsController');
Route::get('/view_calendar' , 'EventsController@view_calendar')->name('view_calendar');
Route::get('/calendar_detail/{id}' , 'EventsController@calendar_detail')->name('calendar_detail');
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////Activity Log Routes//////////////////////////////////////////////////////////////
Route::get('activity' , 'ActivityLog@activity_log')->name('activity_log');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////File Uploads Route//////////////////////////////////////////////////////////////
//Route::get('view_documents/{id}' , 'FileUploadsController@view_documents')->name('view_documents');
Route::post('upload_files/{id}' , 'SiteController@upload_files')->name('upload_files');
Route::get('uploads/{id}' , 'SiteController@uploads')->name('uploads');
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////Franchise Route//////////////////////////////////////////////////////////////
Route::get('franchise_reports' , 'FranchiseReportController@reports')->name('franchise_reports');
Route::post('filter_franchise_reports' , 'FranchiseReportController@filter_reports')->name('filter_franchise_reports');

Route::post('filter_franchise_reports_by_quater' , 'FranchiseReportController@filter_franchise_reports_by_quater')->name('filter_franchise_reports_by_quater');
/// ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////0

////////////////////////////////////////////////////Site Route//////////////////////////////////////////////////////////////
Route::get('site_reports' , 'SiteReportsController@reports')->name('site_reports');
Route::post('filter_reports' , 'SiteReportsController@filter_reports')->name('site_filter_reports');

Route::post('filter_site_reports_by_quater' , 'SiteReportsController@filter_site_reports_by_quater')->name('filter_site_reports_by_quater');


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::get('logout_user' , 'UsersController@logout')->name('logout_user');

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::resource('franchise' , 'FranchiseController');
/// ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////Invoice Resource Routes////////////////////////////////////////////////////////
Route::get('invoices/{id}' , 'InvoiceController@index')->name('invoices.index');
Route::get('invoice_create/{id}' , 'InvoiceController@invoice_create')->name('invoice_create');
Route::post('invoice_store/{id}' , 'InvoiceController@invoice_store')->name('invoice_store');
Route::get('edit_invoice/{id}/{site_id}' , 'InvoiceController@edit_invoice')->name('edit_invoice');
Route::post('update_invoice/{id}/{site_id}' , 'InvoiceController@update_invoice')->name('update_invoice');
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////Site Contacts Resource Routes////////////////////////////////////////////////////////
Route::get('site_contacts/{id}' , 'SiteContactController@index')->name('site_contacts');
Route::get('site_create_contacts/{id}' , 'SiteContactController@site_create_contacts')->name('site_create_contacts');
Route::post('site_store_contacts/{id}' , 'SiteContactController@site_store_contacts')->name('site_store_contacts');
Route::get('edit_site_contact/{id}/{site_id}' , 'SiteContactController@edit_site_contact')->name('edit_site_contact');
Route::post('update_site_contact/{id}/{site_id}' , 'SiteContactController@update_site_contact')->name('update_site_contact');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////Quick Access///////////////////////////////////////////////////////////
Route::get('all_contacts' , 'SiteContactController@get_all_contacts')->name('get_all_contacts');
Route::get('visitations' , 'VisitationsController@get_all_visitations')->name('get_all_visitations');
Route::get('all_invoices' , 'InvoiceController@get_all_invoices')->name('get_all_invoices');
/// ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////Set Visitation Date Flag//////////////////////////////////////////////
Route::get('validate_date' , 'SetDateFlagController@validateSetDate')->name('validateSetDate');
Route::get('set_date' , 'SetDateFlagController@set_date')->name('set_date');
Route::post('store_date' , 'SetDateFlagController@store_date')->name('store_date');
Route::get('edit_date/{id}' , 'SetDateFlagController@edit_date')->name('edit_date');
Route::post('update_date/{id}' , 'SetDateFlagController@update_date')->name('update_date');
/// ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////Set Visitation Date Flag///////////////////////////////////////////////////
Route::get('overdue_visitations_without_tasks' , 'TasksController@overdue_visitations_without_tasks')->name('overdue_visitations_without_tasks');
Route::get('create_visitations_without_tasks/{id}/{visitation_id}' , 'TasksController@create_visitations_without_tasks')->name('create_visitations_without_tasks');
Route::post('store_visitations_without_tasks/{id}/{visitation_id}' , 'TasksController@store_visitations_without_tasks')->name('store_visitations_without_tasks');
Route::get('overdue_visitations_with_tasks' , 'TasksController@overdue_visitations_with_tasks')->name('overdue_visitations_with_tasks');
Route::get('tasks_assigned_to_users' , 'TasksController@tasks_assigned_to_users')->name('tasks_assigned_to_users');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///

////////////////////////////////////////////////////Sites Maps Route///////////////////////////////////////////////////////////////////////////

Route::get('/site_map' , 'SiteController@site_map')->name('site_map');
Route::post('/site_franchise_filter' , 'SiteController@site_franchise_filter')->name('site_franchise_filter');
Route::post('/site_owner_filter' , 'SiteController@site_owner_filter')->name('site_owner_filter');

/// ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////