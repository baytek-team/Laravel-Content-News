<?php

Route::group(['as' => 'news.'], function () {
    Route::resource('category', CategoryController::class);
});

Route::resource('news', NewsController::class);
