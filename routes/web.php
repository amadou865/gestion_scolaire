<?php

use App\Http\Controllers\Annee_academiqueController;
use App\Http\Controllers\categorie_niveauxController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\NiveauxController;
use App\Http\Controllers\TarifController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('categorie-niveaux', categorie_niveauxController::class);
Route::resource('filieres', FiliereController::class);
Route::resource('niveaux', NiveauxController::class);
Route::resource('classes', ClasseController::class);
Route::resource('tarifs', TarifController::class);
Route::resource('annee-academiques', Annee_academiqueController::class);
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');