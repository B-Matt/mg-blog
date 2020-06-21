@extends('layouts.dashboard')

@section('notification')
{!! \Session::get('notification') !!}
@endsection

@section('content')
<div class="d-inline-flex mb-4">
    <h1>{{ __('main.general') }}}</h1>
</div>

<div class="container-fluid mb-5">
    <div class="row">
        <div class="col shadow bg-white w-100">
            <form class="bp-create-form p-4" action="{{ route('settings.update', $settings ?? '') }}" method="POST" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mt-4 mb-0">
                    <h3 class="text-uppercase text-primary">{{ __('main.general_s') }}</h3>  
                </div>
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
                <div class="mt-4 mb-0">
                    <h3 class="text-uppercase text-primary">{{ __('main.mobile') }}</h3>  
                </div>
                <div class="form-group">
                    <label for="iconApple">Apple Favicon</label>
                    <input type="url" class="form-control" id="iconApple" name="icon_apple" placeholder="http://imgur.com/" value="{{ isset($settings) == true ? $settings->icon_apple : '' }}" />
                </div>
                <div class="form-group">
                    <label for="themeColor">{{ __('main.theme_color') }}</label>
                    <input type="text" class="form-control" id="themeColor" name="theme_color" placeholder="#ffffff" value="{{ isset($settings) == true ? $settings->theme_color : '' }}" />
                </div>
                <div class="mt-4 mb-0">
                    <h3 class="text-uppercase text-primary">{{ __('main.social') }}</h3>  
                </div>
                <div class="form-group">
                    <label for="facebookProfile">
                        {{ __('main.fb_handle') }}<br>
                        <small>eg. https://www.facebook.com/<b>MasterGamesStudios</b></small>
                    </label>
                    <input type="text" class="form-control" id="facebookProfile" name="profile_facebook" placeholder="MasterGamesStudios" value="{{ isset($settings) == true ? $settings->profile_facebook : '' }}" />
                </div>
                <div class="form-group">
                    <label for="twitterProfile">
                        {{ __('main.tw_handle') }}<br>
                        <small>eg. https://twitter.com/<b>MasterGamesStu2</b></small>
                    </label>
                    <input type="text" class="form-control" id="twitterProfile" name="profile_twitter" placeholder="MasterGamesStu2" value="{{ isset($settings) == true ? $settings->profile_twitter : '' }}" />
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
