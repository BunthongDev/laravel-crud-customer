<?php
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome'); //'customer' is a folder in resources/views and 'index' is a file in that folder
})->name('home');


//example of a route for a login form (not a real login system)
Route::get('/login', function () {
    return view('customer.login-form'); // 'customer' is a folder in resources/views and 'login-form' is a file in that folder
});

// Route for trashing customers
Route::get('customers/trash', [CustomerController::class, 'trashIndex'])->name('customers.trash');

// Route for restoring a trashed customer
Route::patch('/customers/{id}/restore', [CustomerController::class, 'restore'])->name('customers.restore');

// Route for permanently deleting a trashed customer
Route::delete('/customers/{id}/force-delete', [CustomerController::class, 'forceDelete'])->name('customers.forceDelete');

// Resource route for CustomerController
Route::resource('customers', CustomerController::class);

// This will create the following routes:
// GET /customers - index
// GET /customers/create - create
// POST /customers - store
// GET /customers/{customer} - show
// GET /customers/{customer}/edit - edit
// PUT/PATCH /customers/{customer} - update
// DELETE /customers/{customer} - destroy


