<?php

namespace Baytek\Laravel\Content\Types\News\Seeders;

use Illuminate\Database\Seeder;

use Baytek\Laravel\Content\Types\News\Models\News;
use Baytek\Laravel\Content\Types\News\Models\Category;

class FakeDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->generateNewsCategories();
        $this->generateNews();
    }

    protected function generateNewsCategories($total = 10)
    {
        $content_type = content('content-type/news-category', false);

        foreach(range(1,$total) as $index) {
            $category = (factory(Category::class)->make());
            $category->save();

            //Add relationships
            $category->saveRelation('content-type', $content_type);
            $category->saveRelation('parent-id', $content_type);

            //Add metadata
            $category->saveMetadata('author_id', 1);
        }
    }

    protected function generateNews($total = 100)
    {
        //Generate news
        //Assign them to a category
        $content_type = content('content-type/news', false);
        $categories = Category::all();

        $earliest_date = time() - (5*365*24*60*60); //5 years ago
        $latest_date = time();

        foreach(range(1,$total) as $index) {
            //Choose a parent at random
            $category = $categories->random()->id;

            $news = (factory(News::class)->make());
            $news->save();

            //Add relationships
            $news->saveRelation('content-type', $content_type);
            $news->saveRelation('parent-id', $content_type);
            $news->saveRelation('category', $category);

            //Add metadata
            $news->saveMetadata('author_id', 1);
            $news->saveMetadata('news_date', $this->randomDate($earliest_date, $latest_date));
        }
    }

    protected function randomDate($start, $end)
    {
        return date('Y-m-d H:i:s', rand($start, $end));
    }
}
