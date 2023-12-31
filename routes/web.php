<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OurProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileCust;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [HomeController::class, 'index'])->name('Home');
Route::get('/CustProfile', [ProfileCust::class, 'index'])->name('CustProfile')->middleware('auth', 'cekrole:user');

route::fallback(function(){
    return view('app.404');
});

Route::group(['middleware' => ['auth', 'cekrole:admin']], function(){
    Route::get('Dashboard', [DashboardController::class, 'index'])->name('Dashboard');
});

Route::get('/Produk/{kategori}', [OurProductController::class, 'getKategori'] );

Route::get('/Produk', [OurProductController::class, 'index'])->name('GetProduk');
Route::get('/add-to-cart/{id}', [OurProductController::class, 'addToCart'])->name('addTo-Cart');

Route::get('cart', [CartController::class, 'cart'])->name('cart');
Route::patch('update-cart', [CartController::class, 'update'])->name('update_cart');
Route::delete('remove-from-cart', [CartController::class, 'remove'])->name('remove_from_cart');
// Route::post('/Produk/{product}', [OurProductController::class, 'addToCart'])->name('cart.add');

Route::resource('Admin', AdminController::class);
Route::resource('Product', ProductController::class);


Auth::routes();
Route::post('/login', [LoginController::class, 'authenticate']);
