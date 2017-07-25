<?php

namespace Baytek\Laravel\Content\Types\News\Controllers;

use Baytek\Laravel\Content\Types\News\Models\News;
use Baytek\Laravel\Content\Types\News\Models\Category;
use Baytek\Laravel\Content\Types\News\Requests\NewsRequest;
use Baytek\Laravel\Content\Types\News\Scopes\ApprovedNewsScope;

use Baytek\Laravel\Content\Controllers\ContentController;
use Baytek\Laravel\Content\Events\ContentEvent;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Validator;
use View;

class NewsController extends ContentController
{
    /**
     * The model the Content Controller super class will use to access the news
     *
     * @var App\ContentTypes\News\Models\News
     */
    protected $model = News::class;
    protected $request = NewsRequest::class;

    protected $viewPrefix = 'admin';

    /**
     * List of views this content type uses
     * @var [type]
     */
    protected $views = [
        'index' => 'news.index',
        'create' => 'news.create',
        'edit' => 'news.edit',
        'show' => 'news.show',
    ];

    protected $redirectsKey = 'news';

    /**
     * Show the index of all content with content type 'news'
     *
     * @return \Illuminate\Http\Response
     */
    public function index($topicID = null)
    {
        $this->viewData['index'] = [
            'news' => News::paginate(),
            'filter' => 'all',
        ];

        return parent::contentIndex();
    }

    /**
     * Show the form for creating a new webpage.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->viewData['create'] = [
            'categories' => Category::all(),
        ];

        return parent::contentCreate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge(['key' => str_slug((new Carbon($request->news_date))->toDateString().' '.$request->title)]);

        Validator::make(
            $request->all(),
            (new $this->request)->rules(),
            (new $this->request)->messages()
        )->validate();

        $this->redirects = false;

        $news = parent::contentStore($request);
        $news->saveRelation('category', $request->category);
        $news->saveMetadata('news_date', (new Carbon($request->news_date))->toDateTimeString());
        $news->onBit(News::APPROVED)->update();

        //ContentEvent required here, otherwise the parent id isn't properly accessible
        event(new ContentEvent($news));

        return redirect(route('news.edit', $news->id));
    }

    /**
     * Update a newly created news in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->merge(['key' => str_slug((new Carbon($request->news_date))->toDateString().' '.$request->title)]);

        Validator::make(
            $request->all(),
            (new $this->request)->rules(),
            (new $this->request)->messages()
        )->validate();

        $this->redirects = false;

        $news = parent::contentUpdate($request, $id);
        $news->removeRelationByType('category');
        $news->saveRelation('category', $request->category);
        $news->saveMetadata('news_date', (new Carbon($request->news_date))->toDateTimeString());

        //ContentEvent required here, otherwise the parent id isn't properly accessible
        event(new ContentEvent($news));

        return redirect(route('news.edit', $news->id));
    }

    /**
     * Show the form for creating a new webpage.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = $this->bound($id);

        $this->viewData['edit'] = [
            'category' => $news->categoryID(),
            'categories' => Category::all(),
        ];

        return parent::contentEdit($id);
    }

    /**
     * Delete a news
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = $this->bound($id);

        $news->offBit(News::APPROVED)->onBit(News::DELETED)->update();

        //ContentEvent required here, otherwise the parent id isn't properly accessible
        event(new ContentEvent($news));

        return redirect(route('news.index'));
    }
}
