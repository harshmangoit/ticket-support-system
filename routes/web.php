<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LoginConroller;
use App\Http\Controllers\PlanController;
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

Route::get('{social}/login', [LoginConroller::class, 'provider'])->where('social', 'google|github');
Route::get('{social}/callback', [LoginConroller::class, 'callbackHandel'])->where('social', 'google|github');

Route::middleware("auth")->group(function () {
    Route::get('plans', [PlanController::class, 'index']);
    Route::get('plans/{plan}', [PlanController::class, 'show'])->name("plans.show");
    Route::post('subscription', [PlanController::class, 'subscription'])->name("subscription.create");
});
