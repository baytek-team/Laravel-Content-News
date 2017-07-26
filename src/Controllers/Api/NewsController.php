<?php

namespace Baytek\Laravel\Content\Types\News\Controllers\Api;

use Baytek\Laravel\Content\Types\News\Models\News;
use Baytek\Laravel\Content\Types\News\Scopes\NewsScope;
use Baytek\Laravel\Content\Types\News\Scopes\ApprovedNewsScope;

use Baytek\Laravel\Content\Controllers\ApiController;

use Illuminate\Http\Request;

use Carbon\Carbon;

class NewsController extends ApiController
{
    public function all()
    {
        return News::paginate(5);
    }

    public function get($news)
    {
        return News::where('contents.key', $news)
            ->get()
            ->first();
    }

    public function dashboard()
    {
        return News::paginate(3);
    }
}
