<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\admin\DashbordController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\OrdersController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FrontendController;
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

Route::controller(FrontendController::class)->group(function () {
    Route::get('/','index')->name('home');
});

Route::controller(ClientController::class)->group(function () {
    Route::get('/category/{id}/{slug}','category')->name('category');
    Route::get('/single-product/{id}/{slug}','singleProduct')->name('singleProduct');
    Route::get('/add-to-card','addToCard')->name('addToCard');
    Route::post('/add-to-card','addproducttocard')->name('addproducttocard');
    Route::get('/add-to-card-remove/{id}','addproducttocardremove')->name('addproducttocardremove');
    Route::get('/shipping-address','Getshipping')->name('shipping');
    Route::post('/shipping-address','Addshipping')->name('addshipping');

    Route::get('/chec-kout','checkout')->name('checkout');
    Route::post('/place-order','placeorder')->name('placeorder');

    Route::get('/user-profile','userProfile')->name('userProfile');
    Route::get('/user-profile/pending-orders','pendingorders')->name('pendingorders');
    Route::get('/user-profile/history','history')->name('history');

    Route::get('/new-release','NewRelease')->name('newrelease');
    Route::get('/todays-deal','todaysDeal')->name('todaysdeal');
    Route::get('/customer-service','customerService')->name('customerservice');

    Route::get('/search','search')->name('search');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //dashbord
      Route::get('/admin/layouts/template',[DashbordController::class, 'index'])->name('template');

    Route::get('/admin/dashbord',[CategoryController::class, 'dashbord'])->name('admin.dashbord');

      Route::controller(CategoryController::class)->group(function () {
        Route::get('/admin/addCategory','create')->name('addCategory');
        Route::post('/admin/addCategory','store')->name('CategoryStore');
        Route::get('/admin/allCategory','allCategory')->name('allCategory');
        Route::get('/admin/categoryedit/{id}','edit')->name('categoryedit');
        Route::post('/admin/categoryedit/{id}','update')->name('categoryupdate');
        Route::get('/admin/categorydestroy/{id}','destroy')->name('categorydestroy');
        Route::get('/admin/categoryrestore/{id}','restore')->name('categoryrestore');
        Route::get('/admin/categorydelete/{id}','delete')->name('categorydelete');
    });
    Route::controller(SubCategoryController::class)->group(function () {
        Route::get('/admin/addSubcategory','addsubCategory')->name('addsubCategory');
        Route::post('/admin/addSubcategory','store')->name('SubCategoryStore');
        Route::get('/admin/allSubcategory','allSubcategory')->name('allSubategory');
        Route::get('/admin/Subcategoryedit/{id}','edit')->name('Subcategoryedit');
        Route::post('/admin/Subcategoryedit/{id}','update')->name('Subcategoryupdate');
        Route::get('/admin/Subcategorydestroy/{id}','destroy')->name('Subcategorydestroy');
        Route::get('/admin/Subcategoryrestore/{id}','restore')->name('Subcategoryrestore');
        Route::get('/admin/Subcategorydelete/{id}','delete')->name('Subcategorydelete');
    });
    Route::controller(ProductController::class)->group(function () {
        Route::get('/admin/addProduct','addProduct')->name('addProduct');
        Route::post('/admin/addProduct','store')->name('Productstore');
        Route::get('/admin/allProduct','allProduct')->name('allProduct');
        Route::get('/admin/Productedit/{id}','edit')->name('Productedit');
        Route::post('/admin/Productedit/{id}','update')->name('Productupdate');
        Route::get('/admin/Productdestroy/{id}','destroy')->name('Productdestroy');
        Route::get('/admin/Productrestore/{id}','restore')->name('Productrestore');
        Route::get('/admin/Productdelete/{id}','delete')->name('Productdelete');
        //ajax category->SubCategory_list show
        Route::post('/admin/post/subcategorylist','getSubCategoryList');
    });
    Route::controller(OrdersController::class)->group(function () {
        Route::get('/admin/pendingOrders','pendingOrders')->name('pendingOrders');
        Route::post('/admin/pendingOrders/confirm-order/{id}','confirm')->name('confirm');
        Route::get('/admin/confirm-order','confirmorder')->name('confirmordershow');
        Route::get('/admin/confirm-order-remove/{id}','confirmorderremove')->name('confirmorderremove');
    });

});



require __DIR__.'/auth.php';
