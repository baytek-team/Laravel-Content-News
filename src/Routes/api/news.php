<?php

// Load news for the dashboard
Route::get('/dashboard', 'NewsController@dashboard');

// Get a specific news
Route::get('/{news}', 'NewsController@get');

// Gets a paginated list of news
Route::get('/', 'NewsController@all');
