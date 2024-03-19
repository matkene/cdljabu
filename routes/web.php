<?php

use Illuminate\Support\Facades\Route;

//Route::view('/', 'welcome'); another way to view a page

Route::get('/', function () {
    return view('welcome');
});


