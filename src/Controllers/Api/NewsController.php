<?php

namespace Baytek\Laravel\Content\Types\News\Controllers\Api;

use Baytek\Laravel\Content\Types\News\Models\News;
use Baytek\Laravel\Content\Types\News\Scopes\NewsScope;
use Baytek\Laravel\Content\Types\News\Scopes\ApprovedNewsScope;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;

class NewsController extends Controller
{
    public function __construct()
    {
    }

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
