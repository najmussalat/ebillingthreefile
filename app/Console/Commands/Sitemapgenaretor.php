<?php

namespace App\Console\Commands;
use config;
use App\Models\Blog;
use App\Models\Medicine;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Medicineinformation;
use Illuminate\Support\Facades\App;

class Sitemapgenaretor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'sitemap genaretor command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       //for blogs
            $sitemap_posts = App::make("sitemap");
            $posts = Blog::wherestatus(1)->select('slug','updated_at','status','created_at')->latest()->get(); 
            foreach ($posts as $post) {
                $sitemap_posts->add('https://homeobari.com/info/'.$post->slug, $post->updated_at,  '0.8', 'daily');
            }
        
            // create file sitemap-posts.xml in your public folder (format, filename)
            $sitemap_posts->store('xml','sitemap-posts');
 

            $sitemap_medicineinfo = App::make("sitemap");
            $medicine = Medicineinformation::wherestatus(1)->select('slug','updated_at','status','created_at')->latest()->get(); 
            foreach ($medicine as $post) {
                $sitemap_medicineinfo->add('https://homeobari.com/homeo-info/'.$post->slug, $post->update_at,  '0.9', 'daily');
            }
        
            // create file sitemap-posts.xml in your public folder (format, filename)
            $sitemap_medicineinfo->store('xml','sitemap-medicinepost');

            
            $sitemap_medicine = App::make("sitemap");
            $med= Medicine::select('medicinename','updated_at','created_at')->latest()->get(); 
            foreach ($med as $post) {
                $sitemap_medicine->add($post->medicinename, $post->update_at,  '0.5', 'weekly');
            }
        
            // create file sitemap-posts.xml in your public folder (format, filename)
            $sitemap_medicine->store('xml','sitemap-medicine');
 
            // create sitemap
            $sitemap_disease = App::make("sitemap");
        
            // add for disease
            $disease = DB::table('diseases')->select('diseasename','updated_at')->get();
        
            foreach ($disease as $post)
            {
                $sitemap_disease->add($post->diseasename, $post->updated_at, '0.5', 'weekly');
            }
        
            // create file sitemap-tags.xml in your public folder (format, filename)
            $sitemap_disease->store('xml','sitemap-disease');

             // create sitemap
             $sitemap_tags = App::make("sitemap");
               // add items
               $tags = DB::table('categories')->select('category','updated_at')->get();
        
               foreach ($tags as $tag)
               {
                   $sitemap_tags->add($tag->category, $post->updated_at, '0.5', 'weekly');
               }
           
               // create file sitemap-tags.xml in your public folder (format, filename)
               $sitemap_tags->store('xml','sitemap-category');
        
            // create sitemap index
            $sitemap = App::make ("sitemap");
        
            // add sitemaps (loc, lastmod (optional))
            $sitemap->addSitemap('https://homeobari.com/den/sitemap-posts.xml');
            $sitemap->addSitemap('https://homeobari.com/den/sitemap-medicinepost.xml');
            $sitemap->addSitemap('https://homeobari.com/den/sitemap-medicine.xml');
            $sitemap->addSitemap('https://homeobari.com/den/sitemap-disease.xml');
            $sitemap->addSitemap('https://homeobari.com/den/sitemap-category.xml');
        
            // create file sitemap.xml in your public folder (format, filename)
            $sitemap->store('sitemapindex','sitemap');
        info('Sitemap Generate');
      
    }
    }
    
