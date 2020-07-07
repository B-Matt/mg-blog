@extends('layouts.dashboard')

@section('notification')
{!! \Session::get('notification') !!}
@endsection

@section('content')
<div class="d-sm-flex align-items-center mb-4">
    <h1 class="h3 mb-0">{{ __('main.general') }}</h1>                    
</div>

<div class="container-fluid mb-5">
    <div class="row">
        <div class="col shadow bg-white w-100">
            <form class="bp-create-form p-4" action="{{ route('settings.update', $settings ?? '') }}" method="POST" enctype="multipart/form-data">
                @method('put')
                @csrf

                <input type="hidden" name="icon_apple" value="{{ isset($settings) == true ? $settings->icon_apple : '' }}" />
                <input type="hidden" name="theme_color" value="{{ isset($settings) == true ? $settings->theme_color : '' }}" />
                <input type="hidden" name="profile_facebook" value="{{ isset($settings) == true ? $settings->profile_facebook : '' }}" />
                <input type="hidden" name="profile_twitter" value="{{ isset($settings) == true ? $settings->profile_twitter : '' }}" />

                <div class="form-group">
                    <label for="title">{{ __('main.title') }}</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="{{ __('main.title') }}" value="{{ isset($settings) == true ? $settings->title : '' }}" required />
                </div>
                <div class="form-group">
                    <label for="short-title">{{ __('main.short_title') }}</label>
                    <input type="text" class="form-control" id="short-title" name="short_title" placeholder="{{ __('main.short_title') }}" value="{{ isset($settings) == true ? $settings->short_title : '' }}" required />
                </div>
                <div class="form-group">
                    <label for="short-title">{{ __('main.description') }}</label>
                    <input type="text" class="form-control" id="short-title" name="description" placeholder="{{ __('main.description') }}" value="{{ isset($settings) == true ? $settings->description : '' }}" required />
                </div>
                <div class="form-group">
                    <label for="iconFav">Favicon</label>
                    <input type="url" class="form-control" id="iconFav" name="icon_fav" placeholder="http://imgur.com/" value="{{ isset($settings) == true ? $settings->icon_fav : '' }}" />
                </div>
                <div class="form-group">
                    <label for="googleTag">Google Ads Tag</label>
                    <input type="text" class="form-control" id="googleTag" name="google_tag" placeholder="UA-XXXXXXXX-X" value="{{ isset($settings) == true ? $settings->google_tag : '' }}" />
                </div>
                <div class="float-right py-3">
                    <button type="submit" class="btn btn-primary">{{ __('main.submit') }}</button>
                </div>
                {!! app('captcha')->render(); !!}
            </form>
        </div>
    </div>
</div>
@endsection
