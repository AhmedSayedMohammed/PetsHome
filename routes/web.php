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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//consultation routes
 Route::get('consultation','ConsultationController@get')->name('consultation');
 Route::get('/consultation/room/{id}','ConsultationController@getRoom')->name('consultation.room');
 Route::post('/consultation/room/{id}','ConsultationController@postRoom')->name('consultation.room.post');
 Route::post('/consultation/room/consultationcomment','ConsultationController@postConsultationComment')->name('consultation.room.consultationcomment');

 

//adoption section
 Route::get('/adoption','AdoptionController@getAdoption')->name('adoption.get');
 Route::post('/adoption','AdoptionController@postAdoption')->name('adoption.post');
//strret pets section
 Route::get('/street/pets','StreetPetsController@index')->name('section.street.pets.get');
 Route::post('/street/pets','StreetPetsController@store')->name('section.street.pets.post');

//to show others profile
 Route::get('profile/show/other/{prifileid}','UserController@otherProfile')->name('user.profile.other');
 Route::get('profile/users/show','UserController@showProfile')->name('profile.show');

//profile user type
 Route::post('/profile/users/change/admin/{id}','UserController@makeAdmin')->name('make.admin');
 Route::post('/profile/users/change/user/{id}','UserController@makeUser')->name('make.user');
 Route::post('/profile/users/change/doctor/{id}','UserController@makeDoctor')->name('make.doctor');

 Route::post('/profile/users/update/{id}','UserController@updateUser')->name('update.user');

 //sociallite
Route::get('login/github', 'Auth\LoginController@redirectToProvider');
Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('login/facebook', 'Auth\LoginController@redirectToProviderFacebook');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallbackFacebook');


//vue routes
Route::resource('posts','PostController');
Route::resource('comments','CommentController');
Route::post('post/like/{post_id}','PostController@addLike');
Route::post('post/like/remove/{post_id}/{like_id}','PostController@removeLike');

Route::post('/user/follow/{other_id}','PostController@follow');
Route::post('/user/unfollow/{other_id}','PostController@unfollow');

Route::get('consultation/{id}','ConsultationController@getConsultation');
Route::post('consultation/comments/{id}','ConsultationController@postConsultationComment');