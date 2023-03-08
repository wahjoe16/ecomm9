<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function () {
    // Route halaman login admin
    Route::match(['get', 'post'], '/login', [AdminController::class, 'login'])->name('loginAdmin');

    // Route Group Middleware Admin
    Route::group(['middleware' => ['admin']], function () {
        // Route halaman dashboard admin
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboardAdmin');

        // Route untuk update password admin
        Route::match(['get', 'post'], '/update-admin-password', [AdminController::class, 'updatePassword'])->name('updatePasswordAdmin');

        // Route untuk cek password lama
        Route::post('/check-current-password', [AdminController::class, 'checkCurrentPassword']);

        // Route untuk update profil admin
        Route::match(['get', 'post'], 'update-admin-profile', [AdminController::class, 'updateProfile'])->name('updateProfileAdmin');

        // update vendor detail/profil
        Route::match(['get', 'post'], 'update-vendor-profile/{slug}', [AdminController::class, 'updateVendorProfile'])->name('updateProfileVendor');

        // Route untuk view admin, sub admin, vendors
        Route::get('admins/{type?}', [AdminController::class, 'admins'])->name('manageAdmin');

        // route untuk view detail vendor
        Route::get('/view-vendor-details/{id}', [AdminController::class, 'viewVendor'])->name('viewVendor');

        // route untuk update admin status
        Route::post('update-admin-status', [AdminController::class, 'updateAdminStatus'])->name('updateAdminStatus');

        // Route untuk logout admin
        Route::get('/logout', [AdminController::class, 'logout'])->name('logoutAdmin');



        // SECTION
        // Route untuk section management
        Route::get('sections', [SectionController::class, 'sections'])->name('sections');
        // Route untuk merubah status active/inactive section
        Route::post('update-section-status', [SectionController::class, 'updateSectionStatus'])->name('updateSectionStatus');
        // Route untuk add - edit section
        Route::match(['get', 'post'], 'add-edit-section/{id?}', [SectionController::class, 'addEditSection'])->name('addEditSection');
        // Route untuk delete section
        Route::get('delete-Section/{id}', [SectionController::class, 'deleteSection'])->name('deleteSection');

        // CATEGORY
        // Route untuk category management
        Route::get('categories', [CategoryController::class, 'categories'])->name('categories');
        // Route untuk merubah status active/inactive category
        Route::post('update-category-status', [CategoryController::class, 'updateCategoryStatus'])->name('updateCategoryStatus');
        // Route untuk add-edit category
        Route::match(['get', 'post'], 'add-edit-category/{id?}', [CategoryController::class, 'addEditCategory'])->name('addEditCategory');
        // Route untuk append kategor level (subcategory)
        Route::get('append-categories-level', [CategoryController::class, 'appendCategoryLevel'])->name('appendCategoryLevel');
        // Route untuk delete category
        Route::get('delete-category/{id}', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');
        // Route untuk hapus gambar kategori (subcategory)
        Route::get('delete-category-image/{id}', [CategoryController::class, 'deleteCategoryImage'])->name('deleteCategoryImage');

        // Brands
        Route::get('brands', [BrandController::class, 'brands'])->name('brands');
        // Route untuk merubah status active/inactive section
        Route::post('update-brand-status', [BrandController::class, 'updateBrandStatus'])->name('updateBrandStatus');
        // Route untuk add - edit section
        Route::match(['get', 'post'], 'add-edit-brand/{id?}', [BrandController::class, 'addEditBrand'])->name('addEditBrand');
        // Route untuk delete section
        Route::get('delete-brand/{id}', [BrandController::class, 'deleteBrand'])->name('deleteBrand');


        // Products
        Route::get('products', [ProductController::class, 'products'])->name('products');
        // Route untuk merubah status active/inactive Product
        Route::post('update-product-status', [ProductController::class, 'updateProductStatus'])->name('updateProductStatus');
        // Route untuk add - edit Product
        Route::match(['get', 'post'], 'add-edit-product/{id?}', [ProductController::class, 'addEditProduct'])->name('addEditProduct');
        // Route untuk delete Product
        Route::get('delete-product/{id}', [ProductController::class, 'deleteProduct'])->name('deleteProduct');
        // Route untuk delete image product
        Route::get('delete-product-image/{id}', [ProductController::class, 'deleteProductImage'])->name('deleteProductImage');
        // Route untuk delete video product
        Route::get('delete-product-video/{id}', [ProductController::class, 'deleteProductVideo'])->name('deleteProductVideo');
    });
});
