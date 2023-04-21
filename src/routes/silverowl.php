<?php

use AnthonyEdmonds\SilverOwl\Http\Controllers\CategoryController;
use AnthonyEdmonds\SilverOwl\Http\Controllers\CategoryTagController;
use AnthonyEdmonds\SilverOwl\Http\Controllers\ContentController;
use AnthonyEdmonds\SilverOwl\Http\Controllers\ContentTagController;
use AnthonyEdmonds\SilverOwl\Http\Controllers\HomeController;
use AnthonyEdmonds\SilverOwl\Http\Controllers\SearchController;
use AnthonyEdmonds\SilverOwl\Http\Controllers\SignInController;
use AnthonyEdmonds\SilverOwl\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/{category}/{content}', [ContentController::class, 'show'])->name('contents.show');

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
                Route::get('/', [SignInController::class, 'form']);
                Route::post('/', [SignInController::class, 'signIn']);
            });
    });

Route::middleware('auth')
    ->group(function () {
        Route::get('/sign-out', [SignInController::class, 'signOut']);

        Route::prefix('/admin')
            ->name('admin.')
            ->group(function () {
                Route::prefix('/categories')
                    ->name('categories.')
                    ->controller(CategoryController::class)
                    ->group(function () {
                        Route::get('/', 'index')->name('index');
                        Route::get('/{category}', 'edit')->name('edit');
                    });

                Route::prefix('/{category}/{tag}')
                    ->name('category-tags.')
                    ->controller(CategoryTagController::class)
                    ->group(function () {
                        Route::post('/', 'link')->name('link');
                        Route::delete('/', 'unlink')->name('unlink');
                    });

                Route::prefix('/contents')
                    ->name('contents.')
                    ->controller(ContentController::class)
                    ->group(function () {
                        Route::get('/', 'index')->name('index');
                        Route::get('/{content}', 'edit')->name('edit');
                    });

                Route::prefix('/{content}/{tag}')
                    ->name('content-tags.')
                    ->controller(ContentTagController::class)
                    ->group(function () {
                        Route::post('/', 'link')->name('link');
                        Route::delete('/', 'unlink')->name('unlink');
                    });

                Route::prefix('/tags')
                    ->name('tags.')
                    ->controller(TagController::class)
                    ->group(function () {
                        Route::get('/', 'index')->name('index');
                        Route::get('/{tag}', 'edit')->name('edit');
                    });
            });
    });
