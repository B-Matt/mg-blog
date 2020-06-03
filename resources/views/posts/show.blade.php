@extends('layouts.app')

@section('content')
<div class="bp-header">
    <div class="bp-header-content">
        <div class="bp-header-cover h-100 w-100">
            <img src="{{ $post->cover_img }}" alt="{{ $post->title }} Cover" class="img-fluid" />
            <div class="bp-header-title">
                <div class="col-md-5 mx-auto">
                    <div class="bp-title pt-3 pb-3 text-center">
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

<div class="bp-body-container container mb-5">
    <article class="bp-body pt-5 pb-5">
        {!! $post->body_html !!}
    </article>
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
