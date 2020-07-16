@extends('layouts.app')

@section('title')
<title>{!! isset($settings) == true ? $settings->title : config('app.name', 'Laravel') !!} - 404</title>
@endsection

@section('content')
<div class="bp-404">
    <div class="error mx-auto" data-text="404">404</div>
    <p class="lead mb-5">Page Not Found</p>
    <p class="mb-0">It looks like you found a glitch in the matrix...</p>
    <a href="{{ route('index', ['locale'=> app()->getLocale()]) }}">&larr; Back to the blog</a>
</div>
@endsection
