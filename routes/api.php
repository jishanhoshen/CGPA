<?php

use App\Http\Controllers\AppController;
use App\Models\Exam;
use App\Models\Regulation;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Subject;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('semesters', [AppController::class, 'semesters']);
Route::get('subjects/{semester}', [AppController::class, 'subjects']);

Route::prefix('regulation')->group(function () {
    Route::post('/', [AppController::class, 'regulation']);
    Route::get('/all', [AppController::class, 'AllRegulation']);
});

Route::post('cgpa', [AppController::class, 'cgpa'] );
