<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CandidateController;

Route::get('/candidates', [CandidateController::class, 'index']);
Route::delete('/candidates/{candidate}', [CandidateController::class, 'destroy']);