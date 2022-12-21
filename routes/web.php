<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Paper\EpaperController;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });
Route::get('/composer', [EpaperController::class, 'Composer'])->name('/composer');
Route::get('/', [EpaperController::class, 'ePapers'])->name('/');
Route::get('/epaper-view/{id}', [EpaperController::class, 'ePaperView']);
Route::post('/crop-image', [EpaperController::class, 'cropPaper'])->name('/crop-image');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/admin', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('/admin/categories');
    Route::get('/admin/create-categories', [CategoryController::class, 'createCategory'])->name('/admin/create-categories');
    Route::post('/admin/create-category', [CategoryController::class, 'storeCategory'])->name('/admin/create-category');
    Route::post('/admin/delete-category', [CategoryController::class, 'deleteCategory'])->name('/admin/delete-category');
    Route::get('/admin/edit-category/{id}', [CategoryController::class, 'editCategory'])->name('/admin/edit-category');
    Route::post('/admin/update-category', [CategoryController::class, 'updateCategory'])->name('/admin/update-category');
    //sub category
    Route::get('/admin/sub-categories', [CategoryController::class, 'subCategory'])->name('/admin/sub-categories');
    Route::get('/admin/create-sub-categories', [CategoryController::class, 'createSubCategory'])->name('/admin/create-sub-categories');
    Route::post('/admin/store-sub-category', [CategoryController::class, 'storeSubCategory'])->name('/admin/store-sub-category');
    Route::post('/admin/delete-sub-category', [CategoryController::class, 'deleteSubCategory'])->name('/admin/delete-sub-category');
    Route::get('/admin/edit-sub-category/{id}', [CategoryController::class, 'editSubCategory'])->name('/admin/edit-sub-category');
    Route::post('/admin/update-sub-category', [CategoryController::class, 'updateSubCategory'])->name('/admin/update-sub-category');
    //epapers
    Route::get('/admin/epapers', [PdfController::class, 'epapaers'])->name('/admin/epapers');
    Route::get('/admin/epaper-view/{id}', [PdfController::class, 'ePaperView']);
    Route::get('/admin/upload-epaper', [PdfController::class, 'uploadPDF'])->name('/admin/upload-epaper');
    Route::post('/admin/load-sub-categories-by-id', [CategoryController::class, 'loadCategoryById'])->name('/admin/load-sub-categories-by-id');
    Route::post('/admin/storeepaper', [PdfController::class, 'storePDF'])->name('/admin/storeepaper');
    Route::get('/admin/pdf', [PdfController::class, 'MakePdfTOImage'])->name('/admin/pdf');

});
