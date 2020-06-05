@extends('layouts.dashboard')

@section('content')
<div class="d-inline-flex mb-4">
    <h1>All Posts</h1>
    <a href="{{ route('posts.create') }}">                           
        <button class="btn btn-success ml-3 d-inline-flex">
            <i class="dash-icon flaticon-chat"></i>
            <span class="m-1">New Post</span>
        </button>
    </a>
</div>

<div class="container-fluid mb-5">
    <div class="row">
        <div class="col w-100">
            <!-- Accordion -->
            <div id="postsAccord" class="accordion shadow">

                @foreach ($posts as $post)
                <div class="card">
                    <div id="heading{{ $loop->iteration }}" class="card-header bg-white shadow-sm border-0">
                        <h6 class="mb-0 font-weight-bold">
                            
                            <a href="#" data-toggle="collapse" data-target="#collapse{{ $loop->iteration }}" aria-expanded="false"
                                aria-controls="collapse{{ $loop->iteration }}"
                                class="d-block position-relative text-dark text-uppercase collapsible-link py-2">
                                {{ $post->title }}
                            </a>
                        </h6>
                    </div>
                    <div id="collapse{{ $loop->iteration }}" aria-labelledby="heading{{ $loop->iteration }}" data-parent="#postsAccord"
                        class="collapse">
                        <div class="dash-body card-body p-5">
                            <small role="button" class="text-muted"><b>Published:</b> {{\Carbon\Carbon::parse($post->updated_at)->format('d/m/Y')}}</small>                  
                            <div class="d-inline-flex float-right">
                                <a href="{{ route('posts.show', $post->slug) }}" class="mr-3" title="View published version">
                                    <i class="dash-icon flaticon-vision"></i>
                                </a>
                                <a href="#" title="Edit post">
                                    <i class="dash-icon flaticon-pencil"></i>
                                </a>
                            </div>
                            <p class="font-weight-light m-0">
                                {!! $post->body_html !!}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
