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

use App\Post;

Route::get('eloquent', function () {
    $posts = Post::where('id', '>=', '20')
        ->orderBy('id', 'desc')
        ->take(3)
        ->get();

    foreach ($posts as $post) {
        echo "$post->id $post->title <br>";
    }
});

Route::get('posts', function () {
    $posts = Post::get();

    foreach ($posts as $post) {
        echo "
        $post->id
        <strong>{$post->user->get_name}</strong>
        $post->get_title <br>";
    }
});

use App\User;

Route::get('users', function () {
    $users = User::all();

    foreach ($users as $user) {
        echo "
        $user->id
        <strong>$user->get_name</strong>
        {$user->posts->count()} posts<br>";
    }
});

Route::get('collections', function () {
    $users = User::all();

    //dd($users);
    //dd($users->contains(4));
    //dd($users->except([1, 2, 3]));
    //dd($users->only(4));
    //dd($users->find(4));
    dd($users->load('posts'));

});

Route::get('serialization', function () {
    $users = User::all();

    //dd($users->toArray());
    $user = $users->find(1);
    //dd($user);
    dd($user->toJson());

    
});