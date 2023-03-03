<?php

use AnthonyEdmonds\SilverOwl\Http\Controllers\HomeController;
use AnthonyEdmonds\SilverOwl\Http\Controllers\SearchController;
use AnthonyEdmonds\SilverOwl\Http\Controllers\SignInController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('/search')
    ->name('search.')
    ->group(function () {
        Route::get('/start', [SearchController::class, 'index'])->name('start');
        Route::get('/results', [SearchController::class, 'show'])->name('results');
    });

Route::middleware('guest')
    ->group(function () {
        Route::prefix('/sign-in')
            ->name('sign-in')
            ->group(function () {
                Route::get('/', [SignInController::class, 'create']);
                Route::post('/', [SignInController::class, 'store']);
            });
    });

Route::middleware('auth')
    ->group(function () {
        Route::get('/sign-out', [SignInController::class, 'destroy']);

        Route::prefix('/admin')
            ->name('admin.')
            ->group(function () {
                //
            });
    });
