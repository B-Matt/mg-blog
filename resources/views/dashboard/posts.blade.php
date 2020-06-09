@extends('layouts.dashboard')

@section('notification')
{!! \Session::get('notification') !!}
@endsection

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
                                {!! $post->online == 0 ? '<span class="text-muted font-weight-light"> - HIDDEN</span>' : '' !!}
                            </a>
                        </h6>
                    </div>
                    <div id="collapse{{ $loop->iteration }}" aria-labelledby="heading{{ $loop->iteration }}" data-parent="#postsAccord"
                        class="collapse">
                        <div class="dash-body card-body p-5">
                            {!! $post->online == 0 ? '<strong class="text-danger">This post is hidden!</strong><br>' : '' !!}
                            <small role="button" class="text-muted">
                                <i class="dash-icon flaticon-user mr-1"></i> 
                                {{ $post->author->name }}

                                <i class="dash-icon flaticon-calendar ml-2 mr-1"></i> 
                                {{\Carbon\Carbon::parse($post->updated_at)->format('d/m/Y')}}
                            </small>                            
                            <div class="d-inline-flex float-right">
                                <a href="{{ route('posts.show', $post->slug) }}" class="mr-3" title="View published version">
                                    <i class="dash-icon flaticon-vision"></i>
                                </a>
                                <a href="{{ route('posts.edit', $post) }}" class="mr-3" title="Edit post">
                                    <i class="dash-icon flaticon-pencil"></i>
                                </a>
                                <form method="post" action="{{ route('posts.destroy', $post) }}" class="mr-3">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-link p-0" title="Delete post">
                                        <i class="dash-icon flaticon-trash-bin"></i>
                                    </button>
                                </form>
                                <form method="post" action="{{ route('posts.visibility', ['post' => $post]) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-link p-0" title="Change visibility of post" name="visibility" value="{{ ($post->online == 0 ? '1' : '0') }}">
                                        <i class="dash-icon {{ ($post->online == 0 ? 'flaticon-vision' : 'flaticon-vision-1') }}"></i>
                                    </button>                                    
                                </form>
                            </div>
                            <p class="m-0 mt-4">
                                {!! $post->body !!}
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
