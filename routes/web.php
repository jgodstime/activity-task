<?php

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

Route::get('/', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login');
Route::post('/', [App\Http\Controllers\Admin\AuthController::class, 'loginAction'])->name('login.post');

Route::prefix('admin')->middleware(['auth', 'is.admin'])->name('admin.')->group(function () {
    Route::prefix('activities')->name('activities.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Admin\ActivityController::class, 'dashboard'])->name('dashboard');
        Route::post('/', [App\Http\Controllers\Admin\ActivityController::class, 'storeGlobal'])->name('store.global');
        Route::post('/update-global', [App\Http\Controllers\Admin\ActivityController::class, 'updateGlobal'])->name('update.global');
        Route::post('/{activityNo}/delete-global', [App\Http\Controllers\Admin\ActivityController::class, 'destroyGlobal'])->name('delete.global');
        Route::post('/{activityId}/delete-single', [App\Http\Controllers\Admin\ActivityController::class, 'destroySingle'])->name('delete.single');
        Route::get('/', [App\Http\Controllers\Admin\ActivityController::class, 'index'])->name('index');
    });

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('index');
        Route::get('/{userId}/activities', [App\Http\Controllers\Admin\ActivityController::class, 'userActivities'])->name('activities');
        Route::post('/{userId}/activities/store', [App\Http\Controllers\Admin\ActivityController::class, 'storeUserActivity'])->name('activities.store');
        Route::post('/{userId}/activities/delete', [App\Http\Controllers\Admin\ActivityController::class, 'destroySingle'])->name('activities.delete');
        Route::post('/{userId}/activities/update', [App\Http\Controllers\Admin\ActivityController::class, 'updateSingle'])->name('activities.update');
    });
});

Route::get('/logout', function () {
    auth()->logout();

    return redirect()->route('login');
})->name('logout');
