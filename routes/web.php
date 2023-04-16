<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientTransactionController;
use App\Http\Controllers\ClientUserController;
use App\Http\Controllers\CompanyClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanyTransactionController;
use App\Http\Controllers\CompanyUserController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRoleController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| App Routes 
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/store', [UserController::class, 'store']);
        Route::get('/{user}', [UserController::class, 'show']);
        Route::get('/{user}/destroy', [UserController::class, 'destroy']);
    });

    Route::prefix('permission')->group(function () {
        Route::get('/', [PermissionController::class, 'index']);
        Route::get('/store', [PermissionController::class, 'store']);
        Route::get('/{permission}', [PermissionController::class, 'show']);
        Route::get('/{permission}/destroy', [PermissionController::class, 'destroy']);
    });

    Route::prefix('role')->group(function () {
        Route::get('/', [RoleController::class, 'index']);
        Route::get('/store', [RoleController::class, 'store']);
        Route::get('/{role}', [RoleController::class, 'show']);
        Route::get('/{role}/destroy', [RoleController::class, 'destroy']);
    });

    Route::prefix('user/{user}/role')->group(function () {
        Route::get('/', [UserRoleController::class, 'show']);
        Route::get('/{role}/store', [UserRoleController::class, 'store']);
        Route::get('/{role}/destroy', [UserRoleController::class, 'destroy']);
    });

    Route::prefix('role/{role}/permission')->group(function () {
        Route::get('/', [RolePermissionController::class, 'index']);
        Route::get('/{permission}/store', [RolePermissionController::class, 'store']);
        Route::get('/{permission}/destroy', [RolePermissionController::class, 'destroy']);
    });

    Route::prefix('currency')->group(function () {
        Route::get('/', [CurrencyController::class, 'index']);
        Route::get('/store', [CurrencyController::class, 'store']);
        Route::get('/{currency}', [CurrencyController::class, 'show']);
        Route::get('/{currency}/destroy', [CurrencyController::class, 'destroy']);
    });

    Route::prefix('company')->group(function () {
        Route::get('/', [CompanyController::class, 'index']);
        Route::get('/store', [CompanyController::class, 'store']);
        Route::get('/{company}', [CompanyController::class, 'show']);
        Route::get('/{company}/destroy', [CompanyController::class, 'destroy']);
    });

    Route::prefix('client')->group(function () {
        Route::get('/', [ClientController::class, 'index']);
        Route::get('/store', [ClientController::class, 'store']);
        Route::get('/{client}', [ClientController::class, 'show']);
        Route::get('/{client}/destroy', [ClientController::class, 'destroy']);
    });

    Route::prefix('transaction')->group(function () {
        Route::get('/', [TransactionController::class, 'index']);
        Route::get('/{transaction}', [TransactionController::class, 'show']);
    });

    Route::prefix('company/{company}')->group(function () {
        Route::prefix('user')->group(function () {
            Route::get('/', [CompanyUserController::class, 'index']);
            Route::get('/{user}/store', [CompanyUserController::class, 'store']);
            Route::get('/{user}/destroy', [CompanyUserController::class, 'destroy']);
        });

        Route::prefix('client')->group(function () {
            Route::get('/', [CompanyClientController::class, 'index']);
            Route::get('/store', [CompanyClientController::class, 'store']);
            Route::get('/{client}/destroy', [CompanyClientController::class, 'destroy']);
        });

        Route::prefix('transaction')->group(function () {
            Route::get('/', [CompanyTransactionController::class, 'index']);
            Route::get('/{transaction}', [CompanyTransactionController::class, 'show']);
            Route::get('/{transaction}/confirm', [CompanyTransactionController::class, 'confirm']);
            Route::get('/{transaction}/cancel', [CompanyTransactionController::class, 'cancel']);
        });
    });

    Route::prefix('client/{client}')->group(function () {
        Route::prefix('user')->group(function () {
            Route::get('/', [ClientUserController::class, 'index']);
            Route::get('/{user}', [ClientUserController::class, 'show']);
            Route::get('/{user}/store', [ClientUserController::class, 'store']);
            Route::get('/{user}/destroy', [ClientUserController::class, 'destroy']);
        });

        Route::prefix('transaction')->group(function () {
            Route::get('/', [ClientTransactionController::class, 'index']);
            Route::get('/store', [ClientTransactionController::class, 'store']);
            Route::get('/{transaction}', [ClientTransactionController::class, 'show']);
        });
    });
});

/*
|--------------------------------------------------------------------------
| Routes registered by laravel breeze
|--------------------------------------------------------------------------
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
