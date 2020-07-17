<?php echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
@foreach ($categories as $category)
    <url>
        <loc>{{ config('app.url', '') }}/en/category/{{ $category->slug }}</loc>
        <xhtml:link href="{{ config('app.url', '') }}/en/category/{{ $category->slug }}" hreflang="x-default" rel="alternate"/>
        <xhtml:link href="{{ config('app.url', '') }}/hr/category/{{ $category->slug }}" hreflang="hr" rel="alternate"/>
    </url>
@endforeach
</urlset>