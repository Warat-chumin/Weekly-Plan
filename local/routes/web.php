<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('auth.login');
// });

Auth::routes();
Route::get('/table', 'testcontroller@table');
Route::get('/calendar', 'testcontroller@calendar');
Route::get('/team_all', function () {
    return view('test.team_all');
});
Route::get('/team_detail', function () {
    return view('test.team_detail');
});


//Real
Route::get('/', 'DashboardController@index')->middleware('auth');
// Route::get('/', 'CalendarController@index_team_all')->middleware('auth');
Route::get('/dashboard', 'DashboardController@index')->middleware('auth');
Route::get('/home', 'DashboardController@index')->name('home');


Route::get('/calendar/team_all', 'CalendarController@index_team_all')->middleware('auth');
Route::get('/calendar/team/{code_team}', 'CalendarController@index_team')->middleware('auth');
Route::get('/calendar/{employee_code}/all', 'CalendarController@index_employee')->middleware('auth');
Route::post('/calendar/add/{employee_code}', 'CalendarController@index_employee_add')->middleware('auth');
Route::post('/calendar/edit/{employee_code}', 'CalendarController@index_employee_edit')->middleware('auth');
Route::post('/calendar/delete/{employee_code}', 'CalendarController@index_delete_save')->middleware('auth');

Route::get('/weekly_plan/{employee_code}', 'WeeklyPlanController@index')->middleware('auth');
Route::get('/weekly_plan/team/detail', 'WeeklyPlanController@index_team')->middleware('auth');
Route::get('/weekly_plan/team/detail/{id}', 'WeeklyPlanController@index_team_detail')->middleware('auth');

Route::get('/check_in', 'CheckInController@index')->middleware('auth');
Route::get('/check_in/history', 'CheckInController@index_history')->middleware('auth');
Route::post('/check_in/add_in', 'CheckInController@add_in')->middleware('auth');
Route::post('/check_in/add_out', 'CheckInController@add_out')->middleware('auth');

Route::get('/report', 'ReportController@index')->middleware('auth');
Route::get('/report/event', 'ReportController@event')->middleware('auth');
Route::get('/report/eventbydate', 'ReportController@eventByDate')->middleware('auth');

Route::post('/weekly_plan/export/{employee_code}', 'ReportController@index_employee_export')->middleware('auth');

Route::get('/setting/approve', 'SettingController@index_users_approve')->middleware('auth');
Route::post('/setting/approve/accept', 'SettingController@index_users_approve_accept')->middleware('auth');
Route::post('/setting/approve/cancel', 'SettingController@index_users_approve_cancel')->middleware('auth');
Route::post('/register_wait', 'SettingController@index_register_wait')->middleware('auth');

Route::get('/setting/customer', 'SettingController@index_customer')->middleware('auth');
Route::post('/setting/customer/add', 'SettingController@index_customer_add')->middleware('auth');
Route::post('/setting/customer/select', 'SettingController@index_customer_select')->middleware('auth');

Route::get('/setting/project', 'SettingController@index_project')->middleware('auth');
Route::post('/setting/project/add', 'SettingController@index_project_add')->middleware('auth');

Route::get('/setting/customer_approve', 'SettingController@index_customer_approve')->middleware('auth');
Route::post('/setting/customer_approve/accept', 'SettingController@index_customer_approve_accept')->middleware('auth');
Route::post('/setting/customer_approve/cancel', 'SettingController@index_customer_approve_cancel')->middleware('auth');
Route::post('/setting/customer_approve/add', 'SettingController@index_customer_approve_add')->middleware('auth');

Route::get('/setting/project_approve', 'SettingController@index_project_approve')->middleware('auth');
Route::post('/setting/project_approve/accept', 'SettingController@index_project_approve_accept')->middleware('auth');
Route::post('/setting/project_approve/cancel', 'SettingController@index_project_approve_cancel')->middleware('auth');
Route::post('/setting/project_approve/add', 'SettingController@index_project_approve_add')->middleware('auth');

Route::get('/setting/subject', 'SettingController@index_subject')->middleware('auth');
Route::post('/setting/subject/add', 'SettingController@index_subject_add')->middleware('auth');
Route::post('/setting/subject/edit/{id}', 'SettingController@index_subject_edit')->middleware('auth');
Route::post('/setting/subject/delete/{id}', 'SettingController@index_subject_delete')->middleware('auth');

Route::get('/profile_edit', 'SettingController@index_profile_edit')->middleware('auth');
Route::post('/profile_edit/data', 'SettingController@index_profile_edit_save')->middleware('auth');
Route::post('/profile_edit/password', 'SettingController@index_profile_edit_password')->middleware('auth');
Route::post('/profile_edit/avatar', 'SettingController@index_profile_edit_avatar')->middleware('auth');
Route::get('/profile', 'SettingController@index_profile')->middleware('auth');
Route::get('/profile/{id}', 'SettingController@index_profile_detail')->middleware('auth');

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout', function () {
    return abort(404);
});
