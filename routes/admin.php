<?php

use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\AdController;
use App\Http\Controllers\Admin\AdminAuthenticatedController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContractController;
use App\Http\Controllers\Admin\ContractMessageController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\FooterGridOneController;
use App\Http\Controllers\Admin\FooterGridTwoController;
use App\Http\Controllers\Admin\FooterGridThreeController;
use App\Http\Controllers\Admin\FooterInfoController;
use App\Http\Controllers\Admin\HomeSectionSettingController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SocialCountController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\SubscriberController;

// Admin Login Route---------

Route::get('login', [AdminAuthenticatedController::class, 'login'])->name('login');
Route::post('login', [AdminAuthenticatedController::class, 'handleLogin'])->name('handle-login');
// Forgot Password 
Route::get('forgot-password', [AdminAuthenticatedController::class, 'forgotPassword'])->name('forgot-password');
Route::post('forgot-password', [AdminAuthenticatedController::class, 'sendResetLink'])->name('forgot-password.sendLink');
Route::get('reset-password/{token}', [AdminAuthenticatedController::class, 'resetPasswordLink'])->name('reset-password-link');
Route::post('reset-password', [AdminAuthenticatedController::class, 'handleNewPassword'])->name('add-new-password');

Route::middleware(['admin'])->group(function () {
  Route::get('dashboard', [DashBoardController::class, 'index'])->name('dashboard');
  Route::post('logout', [AdminAuthenticatedController::class, 'destroy'])->name('logout');
  #Admin Password Update===========>
  Route::put('profile-password-update/{id}', [ProfileController::class, 'passwordUpdate'])->name('profile-password.update');
  #Admin Profile Route=============>
  Route::resource('profile', ProfileController::class);
  #Language Routes========>
  Route::resource('language', LanguageController::class);
  #Category Route==========>
  Route::resource('category', CategoryController::class);
  #News Route===============>
  Route::get('fetch-news-category', [NewsController::class, 'fetchCategory'])->name('fetch-news-category');

  Route::get('news/copy/{id}', [NewsController::class, 'copyNews'])->name('copy-news');
  Route::resource('news', NewsController::class);

  // Home Section Setting Controller 
  Route::get('home-section-setting', [HomeSectionSettingController::class, 'index'])->name('home-section-setting.index');
  Route::put('home-section-setting', [HomeSectionSettingController::class, 'update'])->name('home-section-setting.update');

  //Social Count Route 
  Route::resource('social-count', SocialCountController::class);

  // Ads Route 
  Route::resource('ads', AdController::class);

  //Subscriber Rout
  Route::resource('subscriber', SubscriberController::class);

  //Social Link Route

  Route::resource('social-link', SocialLinkController::class);

  //Footer Info
  Route::resource('footer-info', FooterInfoController::class);

  //Footer Info Route
  Route::post('footer-grid-one-title', [FooterGridOneController::class, 'handleTitle'])->name('footer-grid-one-title');
  Route::resource('footer-grid-one', FooterGridOneController::class);
  Route::post('footer-grid-two-title', [FooterGridTwoController::class, 'handleTitle'])->name('footer-grid-two-title');
  Route::resource('footer-grid-two', FooterGridTwoController::class);
  Route::post('footer-grid-three-title', [FooterGridThreeController::class, 'handleTitle'])->name('footer-grid-three-title');
  Route::resource('footer-grid-three', FooterGridThreeController::class);

  //About Us 
  Route::resource('about-us', AboutUsController::class);
  // Contact Us
  Route::resource('contract-us', ContractController::class);
  //Contract Message
  Route::get('user-contact-message', [ContractMessageController::class, 'index'])->name('user-contract-message');
  Route::post('user-contact-message/reply', [ContractMessageController::class, 'messageReply'])->name('user-contract-message.reply');

  //Setting Route
  Route::get('setting', [SettingController::class, 'index'])->name('setting.index');
  Route::put('general-setting', [SettingController::class, 'updateGeneralSetting'])->name('setting-setting.update');
  Route::put('seo-setting', [SettingController::class, 'updateSeoSetting'])->name('seo-setting.update');
});
