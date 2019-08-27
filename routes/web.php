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

Route::get('/', function () {
    return view('welcome');
});
Route::get('login','Auth\LoginController@showlogin');
Route::post('dologin', 'Auth\LoginController@dologin');
Route::get('logout', 'Auth\LoginController@logout');



Route::get('member', 'MemberController@index');
Route::get('course', 'FindNewCourseController@index');
Route::post('course-serach', 'FindNewCourseController@advancedSearch');

Route::get('my-training', 'MyTrainingController@index');
Route::get('my-results', 'MyResultsController@index');
Route::get('generate-certificate/{id}', 'MyResultsController@getCertificate');


Route::post('verify-certificate', 'ModalController@verify_certificate');
Route::post('onsite-training', 'ModalController@onsite_training');
Route::post('onsite-training', 'ModalController@onsite_training');

Route::get('my-details', 'UserController@my_details');
Route::get('user/profile/{id}', 'UserController@profile');
Route::post('update_mydetails', 'UserController@update_mydetails');

// add couse list to db
Route::get('add-course', 'CourseController@store');

Route::get('courses-skillmaintenance', 'CourseSkillMaintenanceController@index');
Route::post('courses-skillmaintenance-serach', 'CourseSkillMaintenanceController@advancedSearch');
Route::get('administrater', 'AdiministraterController@index');
Route::get('get_delivery_mode/ajax/{id}',array('as'=>'Adiministrater.ajax','uses'=>'AdiministraterController@get_delivery_mode'));
Route::get('admin/profile/{id}', 'AdiministraterController@profile');
Route::get('admin-details', 'AdiministraterController@my_details');
Route::post('create-course-post', 'AdiministraterController@create_course_details');