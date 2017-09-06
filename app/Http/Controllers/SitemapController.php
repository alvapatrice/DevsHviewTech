<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;


class SitemapController extends Controller {

    public function generate_xml(Filesystem $filesystem)
    {
        // create new sitemap object
        $sitemap = \App::make("sitemap");

        // set cache (key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean))
        // by default cache is disabled
//        $sitemap->setCache('laravel.sitemap', 60);

        // check if there is cached sitemap and build new only if is not
        if (!$sitemap->isCached()) {
            // add item to the sitemap (url, date, priority, freq)
            $sitemap->add(\URL::to('/'), \Carbon\Carbon::now(), '1.0', 'daily');
            $sitemap->add(\URL::to('/categories'), \Carbon\Carbon::now(), '1.0', 'daily');
            $sitemap->add(\URL::to('/forum'), \Carbon\Carbon::now(), '1.0', 'daily');
            $sitemap->add(\URL::to('/auth/login'), \Carbon\Carbon::now(), '1.0', 'daily');
            $sitemap->add(\URL::to('/auth/register'), \Carbon\Carbon::now(), '1.0', 'daily');
            $sitemap->add(\URL::to('/contact'), \Carbon\Carbon::now(), '0.8', 'monthly');
            $sitemap->add(\URL::to('/about'), \Carbon\Carbon::now(), '0.8', 'monthly');
            $sitemap->add(\URL::to('/privacy'), \Carbon\Carbon::now(), '0.8', 'monthly');

            // get all posts from db
            $articles = $this->getDataFromTable('articles');
            $categories = $this->getDataFromTable('categories');
            $threads = $this->getDataFromTable('threads');

            // add every post to the sitemap
            $this->addDataToSitemap($sitemap, 'articles.single', $articles);
            $this->addDataToSitemap($sitemap, 'categories.single', $categories);
            $this->addDataToSitemap($sitemap, 'threads.single.show', $threads, true);

            $this->saveDataToFile($sitemap, 'xml', $filesystem);
            $this->saveDataToFile($sitemap, 'html', $filesystem);

            return redirect()->back()->with('flash_message', 'Sitemap Generated Sucessfully');

        }
            return redirect()->back()->with('flash_message', 'Sitemap is Generated Less than an hour ago');
    }

    protected function getDataFromTable($table)
    {
        return \DB::table($table)->orderBy('created_at', 'desc')->get();
    }
    protected function getSingleColumnFormTable($table, $whereData, $column)
    {
        return \DB::table($table)->where('id', $whereData)->orderBy('created_at', 'desc')->value($column);
    }
    protected function addDataToSitemap($sitemap, $routeName, $dataArray, $is_thread = false)
    {
        foreach($dataArray as $data)
        {
            if(property_exists($data, 'category_id') && $is_thread)
            {
                $category_name = $this->getSingleColumnFormTable('thread_categories', $data->category_id, 'slug');
                $sitemap->add(route($routeName, [$category_name, $data->slug]), $data->updated_at, '0.8' , 'daily');
            }
            else {
                $sitemap->add(route($routeName, [$data->slug]), $data->updated_at, '0.8' , 'daily');
            }
        }
    }
    protected function saveDataToFile($sitemap, $type, $filesystem)
    {
        $sitemap_generated = $sitemap->render($type);
        if ($type == 'xml')
        {
            $sitemap_generated = substr($sitemap_generated, strpos($sitemap_generated, '<?xml'), strlen($sitemap_generated) ) ;
        }
        else
        {
            $sitemap_generated = str_replace('http://localhost', 'http://devartisans.com', $sitemap_generated) ;
        }
        return $filesystem->put('sitemap.'.$type, $sitemap_generated);
    }

}
