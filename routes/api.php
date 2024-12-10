<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/ping', function (Request $request) {
    $connection = DB::connection('mongodb');
    $msg = 'You are connected to MongoDB';

    try {
        $connection->command(['ping' => 1]);
        dump($msg);
    } catch (\Exception $e) {
        $msg = 'You are not connected to MongoDB Error: ' . $e->getMessage();
        dump($msg);
    }
});

Route::controller(\App\Http\Controllers\TaskController::class)
    ->prefix('tasks')
    ->group(function() {
        Route::get('/', 'index');
        Route::get('/{task:uuid}', 'show');
        Route::post('/', 'store');
        Route::put('/{task:uuid}', 'update');
        Route::delete('/{task:uuid}', 'destroy');
});