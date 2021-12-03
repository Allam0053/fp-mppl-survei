<?php

use App\Http\Controllers\SurveyController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('survey-data', [SurveyController::class, 'getSurveyDataPage'])->name('survey-data');
Route::get('survey-data/add-question', [SurveyController::class, 'getSurveyDataAddForm'])->name('survey-data-form');
Route::post('survey-data/add-question', [SurveyController::class, 'postSurveyData'])->name('survey-data-post');

Route::get('survey-data/result', [SurveyController::class, 'getSurveyResultPage'])->name('survey-data-result');

require __DIR__ . '/auth.php';
