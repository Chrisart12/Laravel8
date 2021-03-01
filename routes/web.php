<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaysController;
use App\Http\Controllers\ImageController;

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

Route::get('/about', function () {
    return view('about');
});


Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/pays', [PaysController::class, 'pays'])->name('pays');
Route::get('/choix', [PaysController::class, 'choix'])->name('choix');
Route::post('/create', [PaysController::class, 'create'])->name('create_pays');
Route::get('/image', [ImageController::class, 'image'])->name('image')->middleware('auth');
Route::post('/create_image', [ImageController::class, 'create_image'])->name('create_image');
Route::post('/upload_image', [ImageController::class, 'upload_image'])->name('upload_image');

Route::get('/imageCropper', [ImageController::class, 'imageCropper'])->name('imageCropper')->middleware('auth');
Route::post('/upload_image_crop', [ImageController::class, 'upload_image_crop'])->name('upload_image_crop');

// Route::get('/images/{user_id}/{image}', [ImageController::class, 'toto'])->name('download');


// dd(Response::download(Config::get('custom.image_path') .'\user_5' . "\image_user_5_1613510481.jpg"));

Route::get('/images/{user_id}/{image}', function($user_id, $image = null)
{

    $path = Config::get('custom.image_path') .'user_' . $user_id . '/' . $image;

    if (file_exists($path)) {
        return Response::file($path);
    }
});

// dd(Storage::disk('laravel_8_data'));


Route::get('/notfound', function()
{
    // $path = "D:/test/notfound.jpg";

    // // // dd($path);
    // if (file_exists($path)) {
    //     // dd(Response::file("resources/user_5/image_user_5_1613515864.PNG"));
    //     return Response::file("resources/user_5/image_user_5_1613515864.PNG");
    // }

    // return Storage::disk('laravel_8_data')->get('notfound.jpg');
    return Storage::disk('laravel_8_data')->response('image_user_5_1613421326.PNG');
    // return Storage::get('notfound.jpg');
});


