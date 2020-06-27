@extends('layouts.app')

@section('title')
<title>{!! isset($settings) == true ? $settings->title : config('app.name', 'Laravel') !!}</title>
@endsection

@section('content')
<div class="container-fluid my-5">
    <div class="bp-all-posts">
        <div class="row">
            @foreach ($posts as $post)
            @if($loop->iteration == 1)
            <div class="bp-sticky col mx-auto">
            @else
            <div class="row">
                <div class="bp-normal col-md-4">
            @endif
                <a href="{{ route('posts.show', ['locale' => app()->getLocale(),'post' => $post->slug]) }}" class="bp-link"></a>
                <div class="card mx-auto">
                    @if($loop->iteration == 1)
                    <div class="row no-gutters">
                        <div class="bp-post-cover col-md-7">
                            <div class="card-img h-100" style="background-image: url({{ $post->cover_img }})"></div>
                            @else
                            <div class="card-img-top" style="background-image: url({{ $post->cover_img }})"></div>
                            @endif
                            @if($loop->iteration == 1)
                        </div>
                        <div class="col">
                            @endif
                            <div class="card-body h-100 d-flex flex-column">
                                <div class="bp-post-body">
                                    <div class="bp-post-category">
                                        @foreach($post->categories as $category)
                                        <a href="{{ $category->slug }}">{{ $category->name }}</a>
                                        @endforeach
                                    </div>
                                    <h5 class="card-title">{{ $post->title }}</h5>
                                    <small class="card-subtitle mb-2">
                                        <div class="d-inline-flex">
                                            <span class="mr-1">
                                                {{ $post->author->name }}
                                            </span>
                                            <span class="text-muted mr-1">&ndash;</span>
                                            <span class="text-muted">
                                                {{\Carbon\Carbon::parse($post->updated_at)->format('d/m/Y')}}
                                            </span>
                                        </div>
                                        <div class="d-block font-italic text-muted">
                                        @foreach($post->tags as $tag)
                                            @if($loop->iteration < count($post->tags))
                                                {{ $tag->name }},
                                            @else
                                                {{ $tag->name }}
                                            @endif
                                        @endforeach
                                        </div>
                                    </small>
                                    <hr>
                                    <span class="card-text text-justify">
                                        {{ substr(strip_tags($post->body), 0, 205) }}...
                                    </span>
                                </div>
                                @if($loop->iteration == 1)
                                <a href="{{ route('posts.show', array_merge(['post' => $post->slug], ['locale'=> app()->getLocale()])) }}"
                                    class="d-inline-flex mt-auto ml-auto px-0 pr-2 btn btn-link">
                                    {{ __('main.read_more') }}
                                    <img src="{{ asset('/img/arrows.png') }}" class="ml-2" alt="Read more arrows"
                                        width="12" height="11" />
                                </a>
                                @else
                                <a href="{{ route('posts.show', array_merge(['post' => $post->slug], ['locale'=> app()->getLocale()])) }}"
                                    class="d-inline-flex mt-auto ml-auto px-0 btn btn-link">
                                    {{ __('main.read_more') }}
                                    <img src="{{ asset('/img/arrows.png') }}" class="ml-2" alt="Read more arrows"
                                        width="12" height="11" />
                                </a>
                                @endif
                            </div>
                        @if($loop->iteration == 1)
                        </div>
                        @endif
                    </div>
                </div>
                @if($loop->iteration == 1)
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
    <div class="row justify-content-center">
        {{ $posts->links() }}
    </div>
</div>
@endsection
