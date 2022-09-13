<?php
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\RequestController;
use App\Http\Controllers\Admin\RequestListController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\AssetsController;
use App\Http\Controllers\Admin\StocksController;

use Illuminate\Http\Admin\Request;
use Illuminate\Support\Facades\Route;

Route::get('get-all-assets', [AssetsController::class, 'show']);
Route::get('get-all-role', [RolesController::class, 'show']);
Route::get('get-all-permitions', [PermissionsController::class, 'show']);
// 
Route::get('get-all-request', [RequestController::class, 'show']);
Route::post('post-request', [RequestController::class, 'store']);
Route::put('update-request', [RequestListController::class, 'update']);
Route::get('getRequestAprove', [RequestListController::class, 'show']);

// stock api
Route::get('getstock', [StocksController::class, 'show']);


Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Assets
    Route::apiResource('assets', 'AssetsApiController');

    // Teams
    Route::apiResource('teams', 'TeamApiController');

    // Stocks
    Route::apiResource('stocks', 'StocksApiController');

    // Transactions
    Route::apiResource('transactions', 'TransactionsApiController');

});
