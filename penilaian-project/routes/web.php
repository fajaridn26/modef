<?php

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\PortfolioDetailController;
use App\Livewire\Dashboard;
use App\Livewire\PenilaianProject;
use App\Livewire\Profile;
use App\Livewire\ProfilePassword;
use App\Livewire\Project;
use App\Livewire\Userlist;
use Illuminate\Support\Facades\Route;

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

// Guru dan Siswa Routes
// Route::get('/', function () {
//     return view('auth.login');
// })->middleware('auth');

// Route::get('/register', [App\Http\Controllers\RegisterController::class, 'index']);
// Route::post('/register', [App\Http\Controllers\RegisterController::class, 'store']);

// Route::get('/login', [App\Http\Controllers\LoginController::class, 'index'])->name('login')->middleware('guest');
// Route::post('/login', [App\Http\Controllers\LoginController::class, 'authenticate']);
// Route::post('/logout', [App\Http\Controllers\LoginController::class, 'logout']);

// Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->middleware('auth');

// Route::get('/penilaian-portofolio', [App\Http\Controllers\PenilaianPortofolioController::class, 'index'])->middleware('auth');

// Route::get('/user-list', Userlist::class)->middleware('auth');

// Route::get('/project', Project::class)->middleware('auth');
// Route::get('/penilaian-project', PenilaianProject::class)->middleware('auth');

// Route::prefix('profile')->group(function () {
//     Route::get('/', [App\Http\Controllers\ProfileController::class, 'index']);
//     Route::get('/password', [App\Http\Controllers\ProfileController::class, 'changePassword']);
//     Route::put('/{id}', [App\Http\Controllers\ProfileController::class, 'update']);
// });


// // Public Routes
// Route::get('/', [LandingPageController::class, 'index']);

// === Public Routes ===
// Route::get('/', [LandingPageController::class, 'index']);
// Route::get('/portfolio', [PortfolioController::class, 'index']);
// Route::get('/portfolio/{id}', [PortfolioDetailController::class, 'index']);
Route::get('/', [App\Http\Controllers\LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'authenticate']);
Route::get('/register', [App\Http\Controllers\RegisterController::class, 'index']);
Route::post('/register', [App\Http\Controllers\RegisterController::class, 'store']);
Route::get('/forgot-password', [App\Http\Controllers\ForgotPasswordController::class, 'index'])->name('forgot-password');
Route::post('/forgot-password', [App\Http\Controllers\ForgotPasswordController::class, 'store'])->name('forgot-password');
Route::get('/validation-forgot-password/{token}', [App\Http\Controllers\ValidationForgotPasswordController::class, 'index'])->name('validation-forgot-password');
Route::get('/validation-forgot-password/{token}', [App\Http\Controllers\ValidationForgotPasswordController::class, 'store'])->name('validation-forgot-password');
Route::post('/validation-forgot-password-act', [App\Http\Controllers\ValidationForgotPasswordController::class, 'changePassword'])->name('validation-forgot-password-act');

// === Protected Routes ===
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class);
    Route::get('/siswa', Userlist::class);
    Route::get('/project', Project::class);
    Route::get('/penilaian-project', PenilaianProject::class);
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/profile/password', ProfilePassword::class);

    // Route::prefix('profile')->group(function () {
    //     Route::get('/', [App\Http\Controllers\ProfileController::class, 'index']);
    //     Route::get('/password', [App\Http\Controllers\ProfileController::class, 'pageChangePassword']);
    //     Route::put('/password/{id}', [App\Http\Controllers\ProfileController::class, 'changePassword']);
    //     Route::put('/{id}', [App\Http\Controllers\ProfileController::class, 'update']);
    // });

    Route::post('/logout', [App\Http\Controllers\LoginController::class, 'logout']);
});
