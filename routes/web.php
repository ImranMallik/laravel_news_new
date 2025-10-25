<?php


use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\LanguageController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return redirect()->route('admin.login');
// });


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__ . '/auth.php';


//Custom login.......
// Route::get('admin/login', [AuthController::class, 'login'])->name('admin.login');
Route::post('/login-check', [AuthController::class, 'loginCheck'])->name('admin.login.check');
// Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');


// All Frontend Controller ------------------
Route::get('/', [HomeController::class, 'index'])->name('home');

// Language Controller 
Route::get('language', LanguageController::class)->name('language');
// News Details
Route::get('news-details/{slug}', [HomeController::class, 'newsDetails'])->name('news.details');

Route::get('news', [HomeController::class, 'news'])->name('news');

Route::post('news-comment', [HomeController::class, 'handleComment'])->name('news-comment');

Route::post('news-comment-reply', [HomeController::class, 'handelReply'])->name('news-comment-reply');

Route::delete('news-comment-destroy', [HomeController::class, 'commentDestroy'])->name('news-comment-destroy');

//** News Letter Routs  **//
Route::post('subscribe-newsletter', [HomeController::class, 'newsLetter'])->name('subscribe-newsletter');

//** About Page **//
Route::get('about', [HomeController::class, 'about'])->name('about');

// *** Contract Us ***//
Route::get('contract-us', [HomeController::class, 'contractUs'])->name('contract.us');

//*** Submit Contract Form  ***//
Route::post('contract-us', [HomeController::class, 'handleContractData'])->name('contract.submit');
