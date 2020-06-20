<?php echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach ($tags as $tag)
    <url>
        <loc>{{ config('app.url', '') }}/{{ $tag->slug }}</loc>
        <xhtml:link href="{{ config('app.url', '') }}/{{ $tag->slug }}" hreflang="x-default" rel="alternate"/>
        <xhtml:link href="{{ config('app.url', '') }}/hr/{{ $tag->slug }}" hreflang="hr" rel="alternate"/>
    </url>
@endforeach
</urlset>