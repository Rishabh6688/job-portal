<?php
use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompanyController;


// Redirect root URL to companies listing page
Route::get('/', function () {
    return redirect()->route('companies.index');
});

// ==============================
// Authentication Routes
// ==============================
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// ==============================
// Authenticated User Routes
// ==============================
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');

    // Profile Management
    Route::get('/profile/create', [ProfileController::class, 'create'])->name('profile.create');
    Route::post('/profile/store', [ProfileController::class, 'store'])->name('profile.store');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');

    // Companies Listing
    Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');

    // Companies Dashboard (Separate view for users)
    Route::get('/dashboard/companies', [CompanyController::class, 'companiesDashboard'])->name('companies.dashboard');

    // Apply to a company
    Route::post('/companies/{company}/apply', [CompanyController::class, 'apply'])->name('company.apply');

    // Application success page
    Route::get('/application-success', [CompanyController::class, 'applicationSuccess'])->name('application-success');
    Route::get('/companies/{id}', [CompanyController::class, 'show'])->name('companies.show');
Route::post('/companies/{id}/apply', [ApplicationController::class, 'store'])->name('companies.apply');
Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');


Route::post('/companies/{id}/apply', function ($id) {
    // You can add logic here to save the application
    return redirect()->route('application.success');
})->name('companies.apply');

Route::get('/application-success', function () {
    return view('application-success');
})->name('application.success');



});
