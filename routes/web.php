<?php

use App\Http\Controllers\Back\ArticleController;
use App\Http\Controllers\Back\AuthController;
use App\Http\Controllers\Back\CategoryController;
use App\Http\Controllers\Back\ConfigController;
use App\Http\Controllers\Back\Dashboard;
use App\Http\Controllers\Back\PageController;
use App\Http\Controllers\Front\HomePageController;
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

// FRONT END
Route::controller(HomePageController::class)->group(function () {
    Route::get('/', 'index')->name('index1');
    Route::get('/elaqeler', 'contact')->name('contact');
    Route::post('/elaqeler/post', 'contactPost')->name('contactPost');
    Route::get('/kategoria/{category}', 'category')->name('category');
    Route::get('/page/{slug}', 'Page')->name('page');
    Route::get('/meqale/{category}/{slug}', 'single')->name('single');
});


// BACK END
Route::get('/seyfe_aktiv_deyil',function(){
    return view('frontend.offline');
})->name('sayt-baximda');
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::get('/logout', 'logOut')->name('logOut');
    Route::post('/login/post', 'loginPost')->name('loginPost');
});
Route::prefix('admin')->middleware('isAdmin')->group(function () {
    
    Route::controller(Dashboard::class)->group(function () {
        Route::get('/panel', 'index')->name('index');
    });
    Route::resource('meqaleler', ArticleController::class);
    Route::controller(ArticleController::class)->group(function () {
        Route::get('/switch', 'switch')->name('switch');
        Route::get('/Sil/{id}', 'sil')->name('sil');
        Route::get('/Meqaleler/Silinenler', 'trashed')->name('trashed');
    });
    Route::controller(CategoryController::class)->group(function () {
        Route::get('index/categories', 'indexCategories')->name('indexCategories');
        Route::get('index/categories/switch', 'switchcategory')->name('switchcategory');
        Route::post('index/categories/cretae', 'createCategory')->name('createCategory');
        Route::post('index/category/delete', 'deleteCategory')->name('deleteCategory');
        Route::get('index/category/getData/show', 'getData')->name('getData');
        Route::post('index/category/getData/change', 'changeData')->name('changeData');
    });

    // Page root
    Route::controller(PageController::class)->group(function () {
        Route::get('index/Pages', 'indexPages')->name('indexPages');
        Route::get('index/Pages/create', 'indexPagesCreate')->name('indexPagesCreate');
        Route::post('index/Pages/createPage', 'createPage')->name('createPage');
        Route::get('index/Pages/switcPages', 'switcPages')->name('switcPages');
        Route::get('index/Pages/delete/{id}', 'deletePages')->name('deletePages');
        Route::get('index/Pages/edit/page/show/{id}', 'editPageShow')->name('editPageShow');
        Route::post('index/Pages/edit', 'editPage')->name('editPage');
        
    });
    //Config Roots
    Route::controller(ConfigController::class)->group(function () {
        Route::get('index/Configuration', 'indexConfig')->name('indexConfig');
        Route::post('index/Configuration/update', 'updateConfig')->name('updateConfig');
    });
});
Route::get('home', [ToastrController::class, 'index'])->name('home');
