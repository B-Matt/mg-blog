@extends('layouts.app')

@section('title')
<title>{!! $post->title . ' &mdash;' !!} {!! isset($settings) == true ? $settings->short_title : config('app.name', 'Laravel') !!}</title>
@endsection

@section('social-meta')
<meta property="og:locale" content="en_US" />
<meta property="og:title" content="{!! isset($post) == true ? $post->title : config('app.name', 'Laravel') . ' &mdash;' !!} {!! isset($settings) == true ? $settings->short_title : config('app.name', 'Laravel') !!}" />
<meta property="og:site_name" content="{!! isset($post) == true ? $post->title : config('app.name', 'Laravel') . ' &mdash;' !!} {!! isset($settings) == true ? $settings->short_title : config('app.name', 'Laravel') !!}" />
<meta property="og:url" content="{{ URL::current() }}" />
<meta property="og:description" content="{{ isset($post) == true ? substr(strip_tags($post->body), 0, 310) . '&hellip;' : '' }}" />
<meta property="og:type" content="article" />
<meta property="og:image" content="{{ isset($post) == true ? $post->cover_img : '' }}" />
<meta property="og:image:secure_url" content="{{ isset($post) == true ? $post->cover_img : '' }}" />
<meta property="article:publisher" content="https://www.facebook.com/{{ isset($settings) == true ? $settings->profile_facebook : '' }}" />
@foreach($post->tags as $tag)
<meta property="article:tag" content="{{ $tag->slug }}" />
@endforeach

@foreach($post_category as $category)
<meta property="article:section" content="{{ $category->slug }}" />
@endforeach

<meta property="article:published_time" content="{{ isset($post) == true ? $post->create_time() : '' }}" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:description" content="{{ isset($post) == true ? substr(strip_tags($post->body), 0, 310) . '&hellip;' : '' }}" />
<meta name="twitter:title" content="{!! isset($post) == true ? $post->title : config('app.name', 'Laravel') . ' &mdash;' !!} {!! isset($settings) == true ? $settings->short_title : config('app.name', 'Laravel') !!}" />
<meta name="twitter:site" content="@{{ isset($settings) == true ? $settings->profile_twitter : '' }}" />
<meta name="twitter:image" content="{{ isset($post) == true ? $post->cover_img : '' }}" />
<meta name="twitter:creator" content="@{{ isset($post) == true ? $post->profile_twitter : '' }}" />
@endsection

@section('json-ld')
{{ Breadcrumbs::view('breadcrumbs::json-ld', 'post', $post) }}
@endsection

@section('content')
<div class="bp-header">
    <div class="bp-header-content">
        <div class="bp-header-cover h-100 w-100">
            <img src="{{ $post->cover_img }}" alt="{{ $post->title }} Cover" class="img-fluid" />
            <div class="bp-header-title">
                <div class="col-md-5 mx-auto">
                    <div role="button" class="bp-title pt-3 pb-3 text-center">
                        <h1 class="mb-0">{{ $post->title }}</h1>
                        <h6 class="mb-0">
                            {{ $post->author->name }} &ndash;
                            {{\Carbon\Carbon::parse($post->updated_at)->format('d/m/Y')}}
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid py-5">
    <div class="row">
        <article class="col-md-6 offset-md-3">
            <div class="bp-body">
                {!! $post->body !!}
            </div>
        </article>
        <div class="col-md-3">
            <div class="bp-sidebar">
                <ul class="bp-tags px-0">
                    @foreach($post->tags as $tag)
                    <li><a href="{{ route('posts.tagged', ['locale' => app()->getLocale(), 'tag' => $tag->name ?? '']) }}">{{ $tag->name }}</a></li>
                    @endforeach
                </ul>
                <span class="bp-share">{{ __('main.post_share') }}:</span>
                <ul class="bp-social mt-0 px-0">
                    <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ URL::current() }}" rel="noopener" target="_blank"
                            title="{{ __('main.share_post_fb') }}" hreflang="en"><i class="flaticon-facebook"></i></a></li>
                    <li><a href="https://twitter.com/intent/tweet?text={!! $post->title !!} - {!! URL::current() !!}" rel="noopener" target="_blank"
                            title="{{ __('main.share_post_tw') }}" hreflang="en"><i class="flaticon-twitter"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="bp-author">
    <div class="bp-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-2 col-md-1">
                <img src="{{ $post->author->avatar }}" alt="{{ $post->author->name }}'s Avatar" />
            </div>
            <div class="col ml-4">
                <span class="bp-author-stext">{{ __('main.written_by') }}:</span>
                <h3 class="mb-1">{{ $post->author->name }}</h3>
                <small>{{ $post->author->about }}</small>
            </div>
        </div>
    </div>
</div>
@endsection
