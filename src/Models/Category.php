<?php

namespace Baytek\Laravel\Content\Types\News\Models;

use Baytek\Laravel\Content\Models\Content;
use Baytek\Laravel\Content\Types\News\Scopes\CategoryScope;

use Cache;

class Category extends Content
{
	/**
	 * Meta keys that the content expects to save
	 * @var Array
	 */
	// protected $meta = [
	// 	'author_id'
	// ];

	/**
	 * Content keys that will be saved to the relation tables
	 * @var Array
	 */
	public $relationships = [
		'content-type' => 'news-category'
	];


    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        static::addGlobalScope(new CategoryScope);

        parent::boot();
    }
}
