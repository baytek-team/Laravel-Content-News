<?php
namespace Baytek\Laravel\Content\Types\News\Seeders;

use Baytek\Laravel\Content\Seeder;

class NewsSeeder extends Seeder
{
    private $data = [
        [
            'key' => 'news',
            'title' => 'News',
            'content' => \Baytek\Laravel\Content\Types\News\Models\News::class,
            'relations' => [
                ['parent-id', 'content-type']
            ]
        ],
        [
            'key' => 'news-category',
            'title' => 'Category',
            'content' => \Baytek\Laravel\Content\Types\News\Models\Category::class,
            'relations' => [
                ['parent-id', 'content-type'],
            ]
        ],
        [
            'key' => 'news-menu',
            'title' => 'News Navigation Menu',
            'content' => '',
            'relations' => [
                ['content-type', 'menu'],
                ['parent-id', 'admin-menu'],
            ]
        ],
        [
            'key' => 'news-index',
            'title' => 'News',
            'content' => 'news.index',
            'meta' => [
                'type' => 'route',
                'class' => 'item',
                'append' => '</span>',
                'prepend' => '<i class="newspaper left icon"></i><span class="collapseable-text">',
            ],
            'relations' => [
                ['content-type', 'menu-item'],
                ['parent-id', 'news-menu'],
            ]
        ]
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
