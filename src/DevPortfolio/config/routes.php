<?php

use App\Controllers\AdminController;
use App\Controllers\HomeController;
use App\Controllers\IdentificationController;
use App\Controllers\UserController;
use App\Kernel\Services\Router\Route;
use App\Middleware\AdminMiddleware;
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;

return [
    // -- home

    Route::get('/', [HomeController:: class, 'index']),
    Route::get('/home', [HomeController:: class, 'index']),

    // -- other

    Route::get('/about', [HomeController:: class, 'about']),
    Route::get('/faq', [HomeController:: class, 'faq']),

    // -- identification

    Route::get('/identification/login', [IdentificationController:: class, 'open_login_page'], [GuestMiddleware::class]),
    Route::get('/identification/signup', [IdentificationController::class, 'open_registration_page'], [GuestMiddleware::class]),

    Route::get('/identification/logout', [IdentificationController::class, 'logout'], [AuthMiddleware::class]),

    Route::get('/identification/recover_password', [IdentificationController::class, 'processPasswordRecovery'], [GuestMiddleware::class]),

    Route::get('/identification/completed', [IdentificationController::class, 'completed']),

    Route::post('/identification/login', [IdentificationController:: class, 'login_processing'], [GuestMiddleware::class]),
    Route::post('/identification/register', [IdentificationController:: class, 'registration_processing'], [GuestMiddleware::class]),

    // -- error

//    Route::get('/error/404', [null, 'error_404']),

    // -- user

    Route::get('/user/profile', [UserController::class, 'index'], [AuthMiddleware::class]),

    // -- admin

    Route::get('/admin/home', [AdminController::class, 'index'], [AuthMiddleware::class, AdminMiddleware::class]),
];