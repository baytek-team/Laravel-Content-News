<?php

namespace Baytek\Laravel\Content\Types\News\Controllers;

use Baytek\Laravel\Content\Types\News\Models\Category;
use Baytek\Laravel\Content\Types\News\Requests\CategoryRequest;

use Baytek\Laravel\Content\Controllers\ContentController;
use Baytek\Laravel\Content\Models\Content;
use Baytek\Laravel\Content\Events\ContentEvent;

class CategoryController extends ContentController
{
    /**
     * The model the Content Controller super class will use to access the news
     *
     * @var Baytek\Laravel\Content\Types\Webpage\Webpage
     */
    protected $model = Category::class;

    /**
     * [$viewPrefix description]
     * @var string
     */
    protected $viewPrefix = 'admin';
    /**
     * Namespace from which to load the view
     * @var string
     */
    protected $viewNamespace = 'news';
    /**
     * List of views this content type uses
     * @var [type]
     */
    protected $views = [
        'index' => 'category.index',
        'create' => 'category.create',
        'edit' => 'category.edit',
        'show' => 'category.index',
    ];

    protected $redirectsKey = 'news.category';

    /**
     * Show the index of all content with content type 'webpage'
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->viewData['index'] = [
            'categories' => content('content-type/news-category')
                            ->children()
                            ->orderBy('title', 'asc')
                            ->paginate(),
        ];

        return parent::contentIndex();
    }


    /**
     * Show the index of all content with content type 'webpage'
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id = null)
    {
        dd(content($id)->children);

        $this->viewData['index'] = [
            'categories' => Category::withoutGlobalScopes()
                ->childrenOfType(Category::find($id)->key, 'news-category')
                ->paginate(),
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
            'parent' => Content::where('contents.key', 'news-category')->get()->first(),
        ];

        return parent::contentCreate();
    }

    /**
     * Store a newly created news in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $this->redirects = false;

        $request->merge(['key' => str_slug($request->title)]);

        $category = parent::contentStore($request);
        $category->saveRelation('parent-id', $request->parent_id);
        $category->onBit(Category::APPROVED)->save();

        event(new ContentEvent($category));

        return redirect(route($this->redirectsKey.'.index', $category));
    }

    /**
     * Update a category using the parent method
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        return parent::contentUpdate($request, $id);
    }

    /**
     * Show the form for creating a new webpage.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return parent::contentEdit($id);
    }

    /**
     * Destroy a news category
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = $this->bound($id);

        $category->offBit(Category::APPROVED)->onBit(Category::DELETED)->update();

        return parent::contentDestroy($id);
    }

}
