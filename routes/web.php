<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Product_idController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
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
/*
//Всем доступен
Route::view('/', 'welcome')->name('welcome');

//Для гостей
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');//На данную страницу могут войти только не зарегистрированные пользователи ->middleware('guest') при попытке перехода тебя перебросит на домашнюю страницу
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/login', [LoginController::class, 'create'])->name('login');//На данную страницу могут войти только не зарегистрированные пользователи ->middleware('guest') при попытке перехода тебя перебросит на домашнюю страницу
    Route::post('/login', [LoginController::class, 'store']);
});

//Для зарегистрированных
Route::middleware('auth')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');//На данную страницу могут войти только не зарегистрированные пользователи ->middleware('guest') при попытке перехода тебя перебросит на домашнюю страницу
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/login', [LoginController::class, 'create'])->name('login');//На данную страницу могут войти только не зарегистрированные пользователи ->middleware('guest') при попытке перехода тебя перебросит на домашнюю страницу
    Route::post('/login', [LoginController::class, 'store']);

    Route::view('/dashbord', 'dashbord')->name('dashbord');//Заходить на данну страницу можно только зарегистрированным пользователям - middleware('auth')
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

});

*/
//Только админ сможет воспользоваться данным маршрутом
Route::middleware('isadmin')->group( function() {
    Route::get('/admin', [AdminController::class,'create'])->name('admin');
    Route::post('/admin', [AdminController::class,'create_category'])->name('create_category');
    //Route::get('/admin', [AdminController::class,'category_spisok'])->name('category_spisok');
    Route::post('/admin/product', [AdminController::class,'create_product'])->name('create_product');
    Route::get('/admin/product/delete/{id}', [AdminController::class,'delete_product'])->name('delete_product');
    Route::post('/admin/product/update/{id}', [AdminController::class,'update_product'])->name('update_product');
    Route::post('/admin/product/category/{id}', [AdminController::class,'update_category'])->name('update_category');
    Route::post('/admin/product/order/{id}', [AdminController::class,'update_order'])->name('update_order');

    //Route::get('/admin/editing/product/{id}', [ProductController::class,'add_cart'])->name('add_cart');


});

//Обычный переход на страницу
//Route::view('/', 'welcome')->name('welcome');
Route::view('/product', 'product')->name('product');

//Route::view('/dashbord','dashbord')->name('dashbord');
//Route::view('/register', 'register')->name('register');

//(Register) Переход на страницу регистрации и отправка данных при регистрации(переход на страницу и обработка данных при отправке)
Route::get('/register', [RegisterController::class,'create'])->middleware('guest')->name('register');//На данную страницу могут войти только не зарегистрированные пользователи ->middleware('guest') при попытке перехода тебя перебросит на домашнюю страницу
Route::post('/register', [RegisterController::class,'store'])->middleware('guest')->name('register_log');

Route::view('/dashbord','dashbord')->middleware('auth')->name('dashbord');//Заходить на данну страницу можно только зарегистрированным пользователям - middleware('auth')

//(Login)
Route::get('/login', [LoginController::class,'create'])->middleware('guest')->name('login');//На данную страницу могут войти только не зарегистрированные пользователи ->middleware('guest') при попытке перехода тебя перебросит на домашнюю страницу
Route::post('/login', [LoginController::class,'store'])->middleware('guest');
Route::get('/logout', [LoginController::class,'destroy'])->middleware('auth')->name('logout');


//Route::view('/product', 'product')->name('product');
Route::get('/product', [ProductController::class,'index'])->name('product');

Route::get('/product/category/{category}', [ProductController::class,'index2'])->name('productByCategory');
Route::get('/product/cart/{id}', [ProductController::class,'add_cart'])->middleware('auth')->name('add_cart');
Route::get('/product/price/{price}', [ProductController::class,'index_desk_asc'])->name('index_desk_asc');
Route::get('/product/country/{country}', [ProductController::class,'index_country'])->name('index_country');
Route::get('/product/name/{name}', [ProductController::class,'index_name'])->name('index_name');


Route::get('/product/{id}', [Product_idController::class,'add_cart'])->name('add_cart2');
//Route::get('/product_id', [Product_idController::class,'index'])->name('product_id');

Route::get('/', [ProductController::class,'slider'])->name('welcome');
Route::get('/info', [MainController::class,'index'])->name('info');

//Route::view('/cart', 'cart')->name('cart');
Route::get('/cart', [CartController::class,'index'])->middleware('auth')->name('cart');
Route::post('/cart/{id}', [CartController::class,'add_order'])->middleware('auth')->name('add_order');
Route::get('/cart/delete/{id}', [CartController::class,'delete_cart'])->middleware('auth')->name('delete_cart');
//Route::get('/cart/verif/{id}', [CartController::class,'password_verif'])->name('password_verif');

Route::get('/order', [OrderController::class,'order'])->middleware('auth')->name('order');
Route::get('/order/delete/{id}', [OrderController::class,'delete_order'])->middleware('auth')->name('delete_order');
