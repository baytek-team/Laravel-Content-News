<?php

namespace Baytek\Laravel\Content\Types\News\Models;

use Baytek\Laravel\Content\Types\News\Scopes\NewsScope;
use Baytek\Laravel\Content\Types\News\Scopes\ApprovedNewsScope;

use Baytek\Laravel\Content\Models\Content;

use Carbon\Carbon;

class News extends Content
{

    /**
    * Content keys that will be saved to the relation tables
    * @var Array
    */
    public $relationships = [
        'content-type' => 'news'
    ];

    public $translatableMetadata = [
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        static::addGlobalScope(new NewsScope);
        static::addGlobalScope(new ApprovedNewsScope);
        parent::boot();
    }

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function getNewsDateAttribute()
    {
        return new Carbon($this->getMeta('news_date'));
    }

    /**
     * Scope a query to only include deleted events.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDeleted($query)
    {
        return $query->withStatus(News::DELETED);
    }

    public function categoryID()
    {
        return $this->relatedBy('category')->pluck('relation_id')->first();
    }
}
