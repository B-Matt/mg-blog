@extends('layouts.dashboard')

@section('notification')
{!! \Session::get('notification') !!}
@endsection

@section('content')
<div class="d-sm-flex align-items-center mb-4">
    <h1 class="h3 mb-0">{{ __('main.post_all') }}</h1>  
    <a href="{{ route('posts.create', app()->getLocale()) }}">                           
        <button class="btn btn-success ml-3 d-inline-flex">
            <i class="dash-icon flaticon-chat"></i>
            <span class="m-1">{{ __('main.post_new') }}</span>
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
                                {!! $post->online == 0 ? '<span class="text-muted font-weight-light"> -' . __('main.post_hidden_s') . '</span>' : '' !!}
                            </a>
                        </h6>
                    </div>
                    <div id="collapse{{ $loop->iteration }}" aria-labelledby="heading{{ $loop->iteration }}" data-parent="#postsAccord"
                        class="collapse">
                        <div class="dash-body card-body p-5">
                            {!! $post->online == 0 ? '<strong class="text-danger">' . __('main.post_hidden') . '</strong><br>' : '' !!}
                            <small role="button" class="text-muted">
                                <i class="dash-icon flaticon-user mr-1"></i> 
                                {{ $post->author->name }}

                                <i class="dash-icon flaticon-calendar ml-2 mr-1"></i> 
                                {{\Carbon\Carbon::parse($post->updated_at)->format('d/m/Y')}}
                            </small>                            
                            <div class="d-inline-flex float-right">
                                <a href="{{ route('posts.show', ['locale' => app()->getLocale(), 'post' => $slugs[$post->id][0]]) }}" class="mr-3" title="{{ __('main.post_view') }}">
                                    <i class="dash-icon flaticon-vision"></i>
                                </a>
                                <a href="{{ route('posts.edit', ['locale' => app()->getLocale(), 'post' => $post]) }}" class="mr-3" title="{{ __('main.post_edit') }}">
                                    <i class="dash-icon flaticon-pencil"></i>
                                </a>
                                <form method="post" action="{{ route('posts.destroy', ['locale' => app()->getLocale(), 'post' => $post]) }}" class="mr-3">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-link p-0" title="{{ __('main.post_remove') }}">
                                        <i class="dash-icon flaticon-trash-bin"></i>
                                    </button>
                                </form>
                                <form method="post" action="{{ route('posts.visibility', ['locale' => app()->getLocale(), 'post' => $post]) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-link p-0" title="{{ __('main.post_visibility') }}" name="visibility" value="{{ ($post->online == 0 ? '1' : '0') }}">
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