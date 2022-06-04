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
|
*/

Route::group([
    'middleware'=> ['api','api_client']
], function(){
    Route::get('/welcome', [\App\Http\Controllers\API\V1\Welcome::class, 'welcome'])->name('api.welcom'); 
    Route::group([
        'prefix' => 'users'
    ], function()
    {
        Route::get('/', [\App\Http\Controllers\API\V1\UserController::class, 'index'])->name('api.users.list');
        Route::post('/', [\App\Http\Controllers\API\V1\UserController::class, 'store'])->name('api.users.store');
        Route::get('/{user}', [\App\Http\Controllers\API\V1\UserController::class, 'show'])->name('api.users.detail');
    }); 

});
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
