<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
	Route::get('user/{user}/karma-position', [UsersController::class, 'KarmaPosition']);
});
