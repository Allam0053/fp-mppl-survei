<?php

use App\Http\Controllers\SurveyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('survey-data', [SurveyController::class, 'getSurveyDataPage'])->name('survey-data');
Route::get('survey-data/add-question', [SurveyController::class, 'getSurveyDataAddForm'])->name('survey-data-form');
Route::post('survey-data', [SurveyController::class, 'postSurveyData'])->name('survey-data-post');
Route::get('survey-data/{id}/edit-question', [SurveyController::class, 'getSurveyDataEditForm'])->name('survey-data-form-edit');
Route::put('survey-data/{id}', [SurveyController::class, 'putSurveyData'])->name('survey-data-put');

Route::get('survey-data/result', [SurveyController::class, 'getSurveyResultPage'])->name('survey-data-result');

require __DIR__ . '/auth.php';
