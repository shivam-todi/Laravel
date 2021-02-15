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
Auth::routes(['verify' => true]);
Route::view('form','user');
Route::post('submit','Users@submit');

Route::view('loginuser','loginuser');
Route::post('submituser','LoginUsers@login');

Route::get('event', 'TestController@index') -> middleware('authen');
Route::get('job', 'TestController@job') -> middleware('authen');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users', 'Service@Disp') -> middleware('authen');
Route::get('logoutuser','Users@logout')-> middleware('authen');
Route::view('createblog','createblog')-> middleware('authen');
Route::post('blogsubmit','Service@createblog')-> middleware('authen');
Route::get('blogs','Service@displayblog')-> middleware('authen');
Route::get('personalblogs','Service@displaypersonalblog')-> middleware('authen');
Route::get('createcomment/{blog_id}','Service@viewcommentpage')-> middleware('authen');
Route::post('createcomment/submitcomment','Service@createcomment')-> middleware('authen');
Route::get('deletecomment/{blog_id}','Service@viewcomments')-> middleware('authen');
Route::get('deletecomment/delete/{id}','Service@deletecomment')-> middleware('authen');
Route::get('deleteblog/{id}','Service@deleteblog')-> middleware('authen');
Route::get('likeblog/{id}','Service@likeblog')-> middleware('authen');
Route::get('deletecomment/likecomment/{id}','Service@likecomment')-> middleware('authen');
Route::get('editblog/{blog_id}','Service@vieweditblog')-> middleware('authen');
Route::post('editblog/submitedit','Service@editblog')-> middleware('authen');

Route::get('deletecomment/edit/{id}','Service@vieweditcomment')-> middleware('authen');
Route::post('deletecomment/edit/submitedit','Service@editcomment')-> middleware('authen');

Route::get('larademo', function(){
    Larademo::sayHello();
}) -> middleware('authen');

Route::get('addblogimage/{entity_id}','Service@viewaddimage')-> middleware('authen');
Route::post('addblogimage/submitimage','Service@addimage')-> middleware('authen');
Route::get('addblogimage/{entity_id}','Service@viewaddimage')-> middleware('authen');
Route::get('deletecomment/addcommentimage/{entity_id}','Service@viewaddcomimage')-> middleware('authen');
Route::post('deletecomment/addcommentimage/submitimage','Service@addimage')-> middleware('authen');

Route::get('newuser/{user_name}', 'Service@welcomeuser')-> middleware('authen');

Route::get('welcome/{user_name}/{email}', function($user_name, $email) {
  $to_name = 'shivam todi';
  $to_email = 'todishivam@gmail.com';
  $data = array('name' => $user_name, 'body' => "Welcome to CoalShastra!!" );
  Mail::send('mail', $data, function($message) use ($to_name, $to_email){
      $message->to($email)
          ->subject('Welcome to CoalShastra');
  });
  echo "Email sent";
  return redirect('/');
});

Route::get('search','Service@search')-> middleware('authen');
