<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
 <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
    @foreach ($posts as $post)
        <url>
            <loc>https://homeobari.com/medicine-info/{{urlencode($post->slug)}}</loc>
            <changefreq>daily</changefreq>
            <priority>0.5</priority>
           </url>
    @endforeach
</urlset>