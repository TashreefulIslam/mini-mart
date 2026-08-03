<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;


// Home
Route::get('/', function () {
    return app(HomeController::class)->index();
});

// Auth
Route::get('register', [AuthController::class, 'showRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Admin routes
Route::prefix('admin')->middleware([\App\Http\Middleware\AdminMiddleware::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Categories
    Route::get('categories', [AdminCategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('categories/create', [AdminCategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('categories', [AdminCategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('categories/{category}/edit', [AdminCategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('categories/{category}', [AdminCategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('categories/{category}', [AdminCategoryController::class, 'destroy'])->name('admin.categories.destroy');

    // Products
    Route::resource('products', AdminProductController::class, ['as' => 'admin']);

    // Users
    Route::get('users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::post('users/{user}/toggle-role', [AdminUserController::class, 'toggleRole'])->name('admin.users.toggle');
    Route::delete('users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');

    // Orders
    Route::get('orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('orders/{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::post('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
});

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');

// Checkout (requires auth)
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/place', [CheckoutController::class, 'placeOrder'])->name('checkout.place');

    // Customer area
    Route::get('/customer/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
    Route::get('/my-orders', [CustomerOrderController::class, 'index'])->name('customer.orders');
    Route::get('/my-orders/{order}', [CustomerOrderController::class, 'show'])->name('customer.orders.show');
    Route::get('/customer/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/customer/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});
