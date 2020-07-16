@extends('layouts.dashboard')

@section('notification')
{!! \Session::get('notification') !!}
@endsection

@section('content')
<div class="d-sm-flex align-items-center mb-4">
    <h1 class="h3 mb-0">{{ __('main.mobile') }}</h1>                    
</div>

<div class="container-fluid mb-5">
    <div class="row">
        <div class="col shadow bg-white w-100">
            <form class="bp-create-form p-4" action="{{ route('settings.update', $settings ?? '') }}" method="POST" enctype="multipart/form-data">
                @method('put')
                @csrf
                <input type="hidden" name="title" value="{{ isset($settings) == true ? $settings->title : '' }}" />
                <input type="hidden" name="short_title" value="{{ isset($settings) == true ? $settings->short_title : '' }}" />
                <input type="hidden" name="description" value="{{ isset($settings) == true ? $settings->description : '' }}" />
                <input type="hidden" name="icon_fav" value="{{ isset($settings) == true ? $settings->icon_fav : '' }}" />
                <input type="hidden" name="google_tag" value="{{ isset($settings) == true ? $settings->google_tag : '' }}" />
                <input type="hidden" name="profile_facebook" value="{{ isset($settings) == true ? $settings->profile_facebook : '' }}" />
                <input type="hidden" name="og_img" value="{{ isset($settings) == true ? $settings->og_img : '' }}" />
                <input type="hidden" name="profile_twitter" value="{{ isset($settings) == true ? $settings->profile_twitter : '' }}" />
                <input type="hidden" name="twitter_img" value="{{ isset($settings) == true ? $settings->twitter_img : '' }}" />

                <div class="form-group">
                    <label for="iconApple">Apple Favicon (180x180)</label>
                    <input type="url" class="form-control" id="iconApple" name="icon_apple" placeholder="URL" value="{{ isset($settings) == true ? $settings->icon_apple : '' }}" required />
                </div>
                <div class="form-group">
                    <label for="themeColor">{{ __('main.theme_color') }}</label>
                    <input type="text" class="form-control" id="themeColor" name="theme_color" placeholder="#ffffff" value="{{ isset($settings) == true ? $settings->theme_color : '' }}" required />
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
