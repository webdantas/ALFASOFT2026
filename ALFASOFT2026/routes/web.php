<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return redirect()->route('people.index');
});

require __DIR__ . '/auth.php';

// 1. Rota de Listagem de Pessoas (Index)
Route::get('people', [PersonController::class, 'index'])->name('people.index');

// 2. Rotas Protegidas de Pessoas (CRUD)
Route::middleware('auth')->group(function () {
    Route::get('people/create', [PersonController::class, 'create'])->name('people.create'); 
    Route::post('people', [PersonController::class, 'store'])->name('people.store');
    Route::get('people/{person}/edit', [PersonController::class, 'edit'])->name('people.edit');
    Route::put('people/{person}', [PersonController::class, 'update'])->name('people.update');
    Route::delete('people/{person}', [PersonController::class, 'destroy'])->name('people.destroy');
});

// 3. Rota Pública de Detalhes (Show)
Route::get('people/{person}', [PersonController::class, 'show'])->name('people.show');


// Rotas públicas de contatos
Route::get('contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');

Route::middleware('auth')->group(function () {
    Route::get('people/{person}/contacts/create', [ContactController::class, 'create'])->name('people.contacts.create');
    Route::post('people/{person}/contacts', [ContactController::class, 'store'])->name('people.contacts.store');
    Route::get('contacts/{contact}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
    Route::put('contacts/{contact}', [ContactController::class, 'update'])->name('contacts.update');
    Route::delete('contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');
});