<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|'api_client'
*/

Route::group([
    'middleware'=> ['api']
], function(){
    
    Route::group([
        'prefix' => 'users'
    ], function()
    {
        Route::post('/register', [\App\Http\Controllers\API\V1\UserController::class, 'register'])->name('api.users.register');
        Route::post('/login', [\App\Http\Controllers\API\V1\UserController::class, 'login'])->name('api.users.login');
        Route::group(['middleware'=> ['auth:api']], function(){
            Route::post('/logout', [\App\Http\Controllers\API\V1\UserController::class, 'logout'])->name('api.users.logout');
            Route::get('/', [\App\Http\Controllers\API\V1\UserController::class, 'index'])->name('api.users.index');
            Route::get('/{user}', [\App\Http\Controllers\API\V1\UserController::class, 'show'])->name('api.users.detail');
        }); 
    }); 

});
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
