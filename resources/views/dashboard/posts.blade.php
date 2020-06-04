@extends('layouts.dashboard')

@section('content')
<a href="{{ route('posts.create') }}">                           
    <button class="btn btn-success float-right mr-5 d-inline-flex">
        <i class="dash-icon flaticon-chat"></i>
        <span class="m-1">New Post</span>
    </button>
</a>

<div class="container">
    <div class="row">
        <div class="col-lg-10 mx-auto">
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
                            <a href="{{ route('posts.show', $post->slug) }}">
                                <i class="dash-icon flaticon-vision"></i>
                            </a>
                            <a href="#">
                                <i class="dash-icon flaticon-pencil"></i>
                            </a>
                            <p class="font-weight-light m-0">
                                {!! $post->body_html !!}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
@endsection
