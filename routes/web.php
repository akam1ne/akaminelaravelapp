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
  $links = \App\Link::all();
  return view('welcome', ['links' => $links]);
});

Route::get('/submit', function () {
  return view('submit');
});

use Illuminate\Http\Request;

//①POSTで/submitにアクセスする。
Route::post('/submit', function(Request $request){
  //②validateメソッドを使ってバリデーションを行う
  $data = $request->validate([
    'title' => 'required | max:255',
    'url' => 'required | url | max:255',
    'description' => 'required | max:255',
  ]);

  //③Linkモデルを生成
  $link = new App\Link($data);
  $link->save();

  //リダイレクトする
  return redirect('/');
});
