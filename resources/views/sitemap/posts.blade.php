<?php echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
@foreach ($posts as $post)
    <url>
        <loc>{{ config('app.url', '') }}/posts/{{ $post->slug }}</loc>
        <xhtml:link href="{{ config('app.url', '') }}/posts/{{ $post->slug }}" hreflang="x-default" rel="alternate"/>
        <xhtml:link href="{{ config('app.url', '') }}/hr/posts/{{ $post->slug }}" hreflang="hr" rel="alternate"/>
        <lastmod>{{ $post->created_at->tz('UTC')->toAtomString() }}</lastmod>
    </url>
@endforeach
</urlset>