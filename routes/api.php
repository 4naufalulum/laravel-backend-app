<?php

use App\Http\Controllers\Api\{
    CategoryController,
    ProductController,
    AuthController,
    UploadController,
    OrderController,
    CallbackController,
    BannerController,
};
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('image/upload', [UploadController::class, 'uploadImage'])->middleware('auth:sanctum');
Route::post('image/upload-multiple', [UploadController::class, 'uploadMultipleImage'])->middleware('auth:sanctum');
Route::post('orders', [OrderController::class, 'order'])->middleware('auth:sanctum');

Route::post('midtrans/notification/handling', [CallbackController::class, 'callback']);

Route::apiResource('categories', CategoryController::class);
Route::apiResource('products', ProductController::class)->middleware('auth:sanctum');
Route::apiResource('banners', BannerController::class);
Route::post('fcm-token', [AuthController::class, 'updateFcmToken'])->middleware('auth:sanctum');
