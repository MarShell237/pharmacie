<?php

use Illuminate\Support\Facades\Route;

Route::inertia('/', function() {
    return redirect("/admin");
})->name('home');
