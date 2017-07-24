<?php

use Baytek\Laravel\Content\Types\News\Models\Category;
use Baytek\Laravel\Content\Types\News\Models\News;
/**
 * News Categories
 */
$factory->define(Category::class, function (Faker\Generator $faker) {

    $title = ucwords(implode(' ', $faker->unique()->words(rand(1,2))));

    return [
        'key' => str_slug($title),
        'title' => $title,
        'content' => null,
        'status' => Category::APPROVED,
        'language' => App::getLocale(),
    ];
});

/**
 * News Items
 */
$factory->define(News::class, function (Faker\Generator $faker) {

    $title = $faker->sentence();

    return [
        'key' => str_slug($title),
        'title' => $title,
        'content' => implode('<br/><br/>', $faker->paragraphs(rand(2, 4))),
        'status' => News::APPROVED,
        'language' => App::getLocale(),
    ];
});
