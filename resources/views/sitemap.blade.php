<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    @foreach($post as $result)
        <url>
            <loc>{{ url(getCategory($result->cate_id).'/'.$result->slug) }}</loc>
            <lastmod>{{ str_replace('+00:00', 'Z', gmdate('c', strtotime($result->created_at))) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach
</urlset>