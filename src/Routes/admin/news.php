<?php

Route::group(['as' => 'news.'], function () {
    Route::resource('news/category', CategoryController::class);
});

Route::resource('news', NewsController::class);
