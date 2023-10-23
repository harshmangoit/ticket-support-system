<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LoginConroller;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['checkUserStatus', 'auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('ticket', TicketController::class);
    // ->except('ticket.edit');
    Route::get('/ticket/{id}/log', [TicketController::class, 'log'])->name('ticket.log');
    Route::get('/ticket/{id}/close', [TicketController::class, 'close'])->name('ticket.close');
    Route::resource('comment', CommentController::class);
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'checkUserRole'])->group(function () {
    Route::resources([
        'category' => CategoryController::class,
        'user' => UserController::class,
    ]);
    // Route::get('/ticket/{id}/edit', [TicketController::class, 'edit'])->name('ticket.edit');
});

// Route::get('/redirect', function () {
//     $driver = null;
//     if ($_GET['login'] == 'google') {
//         $driver =  Socialite::driver('google');
//     } // else {
//     //     $driver =  Socialite::driver('github');
//     // }
//     return $driver->redirect();
// });

// Route::get('/auth/redirect', function () {
//     return Socialite::driver('google')->redirect();
// });
 
// Route::get('/auth/callback', function () {
//     $user = Socialite::driver('google')->user();
 
//     // $user->token
// });

Route::get('google/login', [LoginConroller::class, 'provider'])->name('google.login');
Route::get('google/callback', [LoginConroller::class, 'callbackHandel'])->name('google.login.callback');

// Route::get('/mail', [MailController::class, 'mail']);
