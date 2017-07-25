<?php
namespace Baytek\Laravel\Content\Types\News\Commands;

use Baytek\Laravel\Content\Models\Content;
use Baytek\Laravel\Content\Commands\Installer;
use Baytek\Laravel\Content\Types\News\Seeders\NewsSeeder;
use Baytek\Laravel\Content\Types\News\Seeders\FakeDataSeeder;
use Baytek\Laravel\Content\Types\News\News;
use Baytek\Laravel\Content\Types\News\NewsContentServiceProvider;
use Spatie\Permission\Models\Permission;

use Artisan;
use DB;

class NewsInstaller extends Installer
{
    public $name = 'News';
    protected $protected = ['News', 'News Category'];
    protected $provider = NewsContentServiceProvider::class;
    protected $model = News::class;
    protected $seeder = NewsSeeder::class;
    protected $fakeSeeder = FakeDataSeeder::class;
    protected $migrationPath = __DIR__.'/../resources/Database/Migrations';

    public function shouldPublish()
    {
        return true;
    }

    public function shouldMigrate()
    {
        $pluginTables = [
            env('DB_PREFIX', '').'contents',
            env('DB_PREFIX', '').'content_meta',
            env('DB_PREFIX', '').'content_histories',
            env('DB_PREFIX', '').'content_relations',
        ];

        return collect(array_map('reset', DB::select('SHOW TABLES')))
            ->intersect($pluginTables)
            ->isEmpty();
    }

    public function shouldSeed()
    {
        $relevantRecords = [
            'news',
        ];

        return Content::whereIn('key', $relevantRecords)->count() === 0;
    }

    public function shouldProtect()
    {
        foreach ($this->protected as $model) {
            foreach(['view', 'create', 'update', 'delete'] as $permission) {

                // If the permission exists in any form do not reseed.
                if(Permission::where('name', title_case($permission.' '.$model))->exists()) {
                    return false;
                }
            }
        }

        return true;
    }
}
