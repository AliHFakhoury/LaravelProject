<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
use App\Http\Controllers\YoutubeController;

Route::get('/test', function(Request $request) {
    return response()->json(['message' => 'API Endpoint works!']);
});

Route::get('/testController', [APIController::class, 'testController']);

Route::get('/getPosts', [APIController::class, 'getPosts']);

Route::post('/createPost', [APIController::class, 'createPost']);

Route::get('/getPost/{id}', [APIController::class, 'getPost']);

Route::delete('/deletePost/{id}', [APIController::class, 'deletePost']);

Route::get('/youtubeAPI/search', [YoutubeController::class, 'search']);

Route::get('/testingCORS', [APIController::class, 'testCORS']);