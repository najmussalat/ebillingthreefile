<?php

namespace App\Http\Controllers\Superadmin;
use Kamaln7\Toastr\Facades\Toastr;
use config;
use App\Models\Blog;
use App\Models\Medicineinformation;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;




class SitemapController extends Controller
{
    public function index(){
        $pageConfigs = ['navbarLarge' => false];
        
       return view('superadmin.command.index',['pageConfigs' => $pageConfigs]);
    }
    public function blogsitemapgenerate(Request $request){
		
		 $sitemap_posts = App::make("sitemap");


    // add items
    $posts = DB::table('blogs')->orderBy('created_at', 'desc')->get();

    foreach ($posts as $post)
    {
        $sitemap_posts->add('https://homeobari.com/info/'.$post->slug, $post->updated_at,  '0.8', 'daily');
    }

    // show sitemap
    $sitemap_posts->store('xml','sitemap-posts');
    // return $sitemap_posts->render('xml');
	}

    public function allsitemap(){
         //for blogs
            $sitemap_posts = App::make("sitemap");
            $posts = Blog::wherestatus(1)->select('slug','updated_at','status','created_at')->latest()->get(); 
            foreach ($posts as $post) {
                $sitemap_posts->add('http://homeobari.com/info/'.$post->slug, $post->updated_t,  '0.8', 'daily');
            }
        
            // create file sitemap-posts.xml in your public folder (format, filename)
            $sitemap_posts->store('xml','sitemap-posts');
 

            $sitemap_medicineinfo = App::make("sitemap");
            $medicine = Medicineinformation::wherestatus(1)->select('slug','updated_at','status','created_at')->latest()->get(); 
            foreach ($medicine as $post) {
                $sitemap_medicineinfo->add('http://homeobari.com/homeo-info/'.$post->slug, $post->update_at,  '0.9', 'daily');
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
            $sitemap->addSitemap('https://homeobari.com/den/public/sitemap-posts.xml');
            $sitemap->addSitemap('https://homeobari.com/den/public/sitemap-medicinepost.xml');
            $sitemap->addSitemap('https://homeobari.com/den/public/sitemap-medicine.xml');
            $sitemap->addSitemap('https://homeobari.com/den/public/sitemap-disease.xml');
            $sitemap->addSitemap('https://homeobari.com/den/public/sitemap-category.xml');
        
            // create file sitemap.xml in your public folder (format, filename)
             $sitemap->render('xml');
          //  $sitemap->store('sitemapindex','sitemap');
        // info('Sitemap Generate');
        Toastr::success("All Sitemap Generate ", "Done");
        return Redirect::to('superadmin/commandlist');
    
    
    }
}
