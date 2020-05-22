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

// Route::get('/', function () {
//     return view('welcome');//it automatically appends the extension to the string passed
// });

//we will go through controller and get required data from database and then redirect to the view page

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;

//Auth::routes();
//for email verification
Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home');

//Job controller
Route::get('/','JobController@index');
Route::get('/jobs/create','JobController@create')->name('job.create');
Route::post('/jobs/store','JobController@store')->name('job.store');
Route::get('/jobs/{id}/edit','JobController@edit')->name('job.edit');
Route::post('/jobs/{id}/edit','JobController@update')->name('job.update');
Route::get('/jobs/my-job','JobController@myjob')->name('my.job');
Route::get('/jobs/alljobs','JobController@allJobs')->name('alljobs');//display all jobs
Route::get('/jobs/applications','JobController@applicant')->name('applicant');

Route::get('/jobs/{id}/{job}','JobController@show')->name('jobs.show');

//Company Controller
Route::get('/company/{id}/{company}','CompanyController@index')->name('company.index');
Route::get('company/create','CompanyController@create')->name('company.view');
Route::post('company/store','CompanyController@store')->name('company.store');
Route::post('company/coverphoto','CompanyController@coverPhoto')->name('cover.photo');
Route::post('company/logo','CompanyController@companyLogo')->name('company.logo');

//user profile
Route::get('user/profile','UserController@index')->name('user.profile');
Route::post('user/profile/create','UserController@store')->name('profile.create');
Route::post('user/avatar','UserController@avatar')->name('avatar');
Route::post('user/coverletter','UserController@coverletter')->name('cover.letter');
Route::post('user/resume','UserController@resume')->name('resume'); 

//Employer view
Route::view('employer/register','auth.employer-register')->name('employer.register');
Route::post('employer/register','EmployerRegisterController@employerRegister')->name('emp.register');
Route::post('/applications/{id}','JobController@apply')->name('apply');//route for applying jobs

//save and unsave jobs
Route::post('/save/{id}','FavouriteController@saveJob');
Route::post('/unsave/{id}','FavouriteController@unSaveJob');


//search
Route::get('/jobs/search','JobController@searchJobs');

//category
Route::get('/category/{id}','CategoryController@index')->name('category.index');   

//company for thr link present in the nav to view all companies
Route::get('/companies','CompanyController@company')->name('company');   

//email
Route::post('/job/mail','EmailController@send')->name('mail');

//admin
Route::get('/dashboard','DashboardController@index')->middleware('admin');
Route::get('/dashboard/create','DashboardController@create')->middleware('admin');  
Route::post('/dashboard/create','DashboardController@store')->name('post.store')->middleware('admin');  
Route::post('/dashboard/destroy','DashboardController@destroy')->name('post.delete')->middleware('admin'); 
Route::get('/dashboard/{id}/edit','DashboardController@edit')->name('post.edit')->middleware('admin');   
Route::post('/dashboard/{id}/update','DashboardController@update')->name('post.update')->middleware('admin');   
//admin trash restore routes
Route::get('/dashboard/trash','DashboardController@trash')->middleware('admin');
Route::get('/dashboard/{id}/trash','DashboardController@restore')->name('post.restore')->middleware('admin');
//toggle the status 
Route::get('/dashboard/{id}/toggle','DashboardController@toggle')->name('post.toggle')->middleware('admin');
//to read the blog posted by admin from home page here we dont need admin middleware as we want anyone to read this blog post
Route::get('/post/{id}/{slug}','DashboardController@show')->name('post.show');
//to display all the jobs for the admin to control
Route::get('/dashboard/jobs','DashboardController@getAllJobs')->name('job.show')->middleware('admin');
//toggling the jobs
Route::get('/dashboard/{id}/jobs','DashboardController@changeJobStatus')->name('job.status')->middleware('admin');

//Testimonial routes
Route::get('testimonial','TestimonialController@index')->middleware('admin');
Route::get('testimonial/create','TestimonialController@create')->middleware('admin');
//after creating the testimonial u need to submit so to submit post method and middleware so that only admin can access this
Route::post('testimonial/create','TestimonialController@store')->name('testimonial.store')->middleware('admin');