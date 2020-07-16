@extends('layouts.dashboard')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0">{{ __('main.dashboard') }}</h1>                       
</div>
<div class="dash-stats row">
    <div class="col-xl-3 col-md-6 mb-4" role="button">
        <div class="card shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">
                            {{ __('main.dash_stats_posts') }}
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-dark">{{ $stats['post_count'] }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4" role="button">
        <div class="card shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">
                            {{ __('main.dash_stats_hidden') }}
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-dark">{{ $stats['hidden_count'] }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4" role="button">
        <div class="card shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">
                            {{ __('main.dash_stats_total') }}
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-dark">{{ $stats['user_count'] }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4" role="button">
        <div class="card shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">
                            {{ __('main.dash_stats_categories') }}
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-dark">{{ count($categories) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-lg-6 mb-4" role="button">
        <div class="dash-info card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ __('main.activity')}}</h6>
            </div>
            <div class="card-body">
                <ul class="dash-list p-0">
                    @foreach($recent_posts as $post)
                    <li>
                        <div class="d-inline">
                            <a href="{{ route('posts.show', ['locale' => app()->getLocale(), 'post' => $slugs[$post->id][0]]) }}" class="float-left">{{ $post->title }}</a>
                            <small class="float-right text-muted"> {{ \Carbon\Carbon::parse($post->updated_at)->format('d/m/Y') }}</small>
                        </div>
                    </li>
                    @endforeach
                </ul>                
            </div>
        </div>
    </div>
    <div class="col-lg-5 mb-4" role="button">
        <div class="dash-info card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ __('main.categories') }}</h6>
            </div>
            <div class="card-body">
                <div class="row dash-list">
                    <div class="col-3 font-weight-bold text-primary">{{ __('main.name') }}</div>
                    <div class="col-4 font-weight-bold text-primary">{{ __('main.description') }}</div>
                    <div class="col-2 font-weight-bold text-primary">{{ __('main.slug') }}</div>
                    <div class="col-3 col-md-2 font-weight-bold text-primary text-right">{{ __('main.action') }}</div>
                </div>
                <ul class="dash-list mt-2">
                    @foreach($categories as $category)
                    <li>
                        <div class="row">
                            <div class="col-3">
                                {{ $category->name }}
                            </div>
                            <div class="col-4">
                                {{ substr(strip_tags($category->description), 0, 17) }}...
                            </div>
                            <div class="col-2">
                                {{ $category->slug }}
                            </div>
                            <div class="col-2 d-inline-flex mx-auto align-items-center">
                                <a href="{{ route('posts.category', ['locale' => app()->getLocale(), 'category' => $category->slug ?? '']) }}" class="ml-2 mr-3">
                                    <i class="dash-icon flaticon-vision"></i>
                                </a>
                                <form method="post" action="{{ route('categories.destroy', $category) }}" class="m-0 w-50">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-link p-0" title="{{ __('main.category_delete') }}">
                                        <i class="dash-icon flaticon-trash-bin"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
                <a href="{{ route('categories.index') }}" class="ml-2">{{ __('main.dash_all_categories') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection