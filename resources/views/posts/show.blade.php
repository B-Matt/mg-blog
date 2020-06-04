@extends('layouts.app')

@section('content')
<div class="bp-header">
    <div class="bp-header-content">
        <div class="bp-header-cover h-100 w-100">
            <img src="{{ $post->cover_img }}" alt="{{ $post->title }} Cover" class="img-fluid" />
            <div class="bp-header-title">
                <div class="col-md-5 mx-auto">
                    <div role="button" class="bp-title pt-3 pb-3 text-center">
                        <h1 class="mb-0">{{$post->title}}</h1>
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
        <article class="col-md-6 offset-3">
            <div class="bp-body">
                {!! $post->body_html !!}
            </div>
        </article>
        <div class="col-md-3">
            <div class="bp-sidebar">
                <ul class="bp-tags px-0">
                    <li style="background: red">Devblog</li>
                    <li>Test</li>
                </ul>
                <span class="bp-share">Share this post:</span>
                <ul class="bp-social mt-0 px-0">
                    <li><a href="https://www.facebook.com/MasterGamesStudios/" rel="noopener" target="_blank"
                            title="Share blog post on Facebook" hreflang="en"><i class="flaticon-facebook"></i></a></li>
                    <li><a href="https://twitter.com/MasterGamesStu2?lang=en" rel="noopener" target="_blank"
                            title="Share blog posts on Twitter" hreflang="en"><i class="flaticon-twitter"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="bp-author">
    <div class="bp-overlay"></div>
    <div class="w-50 mx-auto my-2">
        <div class="container">
            <div class="row">
                <div class="col-md-1">
                    <img src="{{ $post->author->avatar }}" alt="{{ $post->author->name }}'s Avatar" />
                </div>
                <div class="col ml-4">
                    <span class="bp-author-stext">Written by:</span>
                    <h3 class="mb-1">{{ $post->author->name }}</h3>
                    <small>{{ $post->author->about }}</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
