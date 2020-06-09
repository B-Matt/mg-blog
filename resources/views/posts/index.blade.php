@extends('layouts.app')

@section('content')
<div class="container-fluid my-5">
    <div class="blog-posts row">
        @foreach ($posts as $post)
        @if($loop->iteration == 1)
        <div class="sticky-post mx-auto">
            @else
            <div class="normal-post col-md-4">
            @endif
            <a href="{{ route('posts.show', $post->slug) }}" class="post-link"></a>
            <div class="card mx-auto">
                @if($loop->iteration == 1)
                <div class="row no-gutters">
                    <div class="col-md-7">
                        <img class="card-img h-100" src="{{ $post->cover_img }}" alt="{{ $post->title }} Cover">
                        @else
                        <img class="card-img-top" src="{{ $post->cover_img }}" alt="{{ $post->title }} Cover">
                        @endif

                        @if($loop->iteration == 1)
                    </div>
                    <div class="col">
                        @endif
                        <div class="card-body h-100 d-flex flex-column">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <small class="card-subtitle mb-2 d-inline-flex">
                                <span class="mr-1">
                                    {{ $post->author->name }}
                                </span>
                                <span class="text-muted mr-1">&ndash;</span>
                                <span class="text-muted">
                                    {{\Carbon\Carbon::parse($post->updated_at)->format('d/m/Y')}}
                                </span>
                            </small>
                            <hr>
                            <span class="card-text text-justify">
                                {!! $post->summary !!}
                            </span>
                            @if($loop->iteration == 1)
                            <a href="{{route('posts.show', $post->slug)}}"
                                class="d-inline-flex mt-auto ml-auto px-0 pr-2 btn btn-link">
                                Read more
                                <img src="{{ asset('/img/arrows.png') }}" class="ml-2" alt="Read more arrows"
                                    width="12" height="11" />
                            </a>
                            @else
                            <a href="{{route('posts.show', $post->slug)}}"
                                class="d-inline-flex mt-auto mr-auto px-0 btn btn-link">
                                Read more
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
        @endif
        @endforeach
    </div>
    <div class="row justify-content-center">
        {{ $posts->links() }}
    </div>
</div>
@endsection
