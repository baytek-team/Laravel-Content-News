<?php
namespace Baytek\Laravel\Content\Types\News\Seeders;

use Baytek\Laravel\Content\Seeder;

class NewsSeeder extends Seeder
{
    private $data = [
        [
            'key' => 'news',
            'title' => 'News',
            'content' => 'News Content Type',
            'relations' => [
                ['parent-id', 'content-type']
            ]
        ],
        [
            'key' => 'news-category',
            'title' => 'Category',
            'content' => 'News Category Content Type',
            'relations' => [
                ['parent-id', 'content-type'],
            ]
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedStructure($this->data);
    }
}
