<?php

Route::group(['as' => 'news.', 'prefix' => 'news'], function () {
    Route::resource('category', CategoryController::class);
});

Route::resource('news', NewsController::class);
