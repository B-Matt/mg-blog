@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row mb-5">
        <div class="col text-center">
            <h1 class="text-center text-3xl my-8">Blog Posts</h1>

            @auth
            <a class="my-3 hover:underline" href="{{route('posts.create')}}">New article</a>
            @endauth

        </div>
    </div>

    <div class="blog-posts row">
      @foreach ($posts as $post)
        @if($loop->iteration == 1)
          <div class="sticky-post mx-auto mb-5">
        @else
          <div class="normal-post col-md-4 mb-4">
        @endif
            <div class="card mx-auto">
            @if($loop->iteration == 1)
            <div class="row no-gutters">
            <div class="col-md-7">
            <img class="card-img" src="{{ $post->cover_img }}" alt="{{ $post->title }} Cover">
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
                      <span  class="mr-1">&ndash;</span>
                      <span class="text-muted">
                        {{\Carbon\Carbon::parse($post->updated_at)->format('d/m/Y')}}
                      </span>
                    </small>
                    <hr>
                    <span class="card-text text-justify">
                        {!! $post->summary_html !!}
                    </span>
                    @if($loop->iteration == 1)
                    <a href="{{Route('posts.show', $post->slug)}}" class="mt-auto ml-auto px-0 pr-2 btn btn-link">Read more</a>
                    @else
                    <a href="{{Route('posts.show', $post->slug)}}" class="mt-auto mr-auto px-0 btn btn-link">Read more</a>
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
</div>
@endsection
