<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('landing');
// });

Route::get('/', function () {
    $varieties = [
        ['label' => 'W180', 'img' => 'images/img/variety/W180.png'],
        ['label' => 'W240', 'img' => 'images/img/variety/w240.png'],
        ['label' => 'W320', 'img' => 'images/img/variety/w320.png'],
        ['label' => 'LWP',  'img' => 'images/img/variety/lwp.png'],
        ['label' => 'WS',   'img' => 'images/img/variety/ws.png'],
    ];

     $heroMessages = [
        "We have supplied orders through courier across India.",
        "Fresh cashews straight from the hands of farmers.",
        "Handpicked quality, rich flavor, and consistent grading for your needs.",
        "Boosts heart health with rich unsaturated fats.",
        "Packed with antioxidants that strengthen immunity.",
    ];

    // Pick one random message
    $heroMessage = $heroMessages[array_rand($heroMessages)];

    return view('landing', compact('varieties', 'heroMessage'));
});

Auth::routes();

// Shop & Cart routes (public)
Route::get('/shop', [App\Http\Controllers\CartController::class, 'shop']);
Route::get('/cart', [App\Http\Controllers\CartController::class, 'viewCart']);
Route::post('/cart/add', [App\Http\Controllers\CartController::class, 'add']);
Route::post('/cart/update', [App\Http\Controllers\CartController::class, 'update']);
Route::post('/cart/remove', [App\Http\Controllers\CartController::class, 'remove']);
Route::post('/checkout', [App\Http\Controllers\CartController::class, 'checkout']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
