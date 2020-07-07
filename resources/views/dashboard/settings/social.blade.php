@extends('layouts.dashboard')

@section('notification')
{!! \Session::get('notification') !!}
@endsection

@section('content')
<div class="d-sm-flex align-items-center mb-4">
    <h1 class="h3 mb-0">{{ __('main.social') }}</h1>                    
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
                <input type="hidden" name="icon_apple" value="{{ isset($settings) == true ? $settings->icon_apple : '' }}" />
                <input type="hidden" name="theme_color" value="{{ isset($settings) == true ? $settings->theme_color : '' }}" />

                <div class="form-group">
                    <label for="facebookProfile">
                        {{ __('main.fb_handle') }}<br>
                        <small>eg. https://www.facebook.com/<b>MasterGamesStudios</b></small>
                    </label>
                    <input type="text" class="form-control" id="facebookProfile" name="profile_facebook" placeholder="MasterGamesStudios" value="{{ isset($settings) == true ? $settings->profile_facebook : '' }}" />
                </div>
                <div class="form-group">
                    <label for="ogImg">OG Image</label>
                    <input type="url" class="form-control" id="ogImg" name="og_img" placeholder="URL" value="{{ isset($settings) == true ? $settings->og_img : '' }}" required />
                </div>
                <div class="form-group">
                    <label for="twitterProfile">
                        {{ __('main.tw_handle') }}<br>
                        <small>eg. https://twitter.com/<b>MasterGamesStu2</b></small>
                    </label>
                    <input type="text" class="form-control" id="twitterProfile" name="profile_twitter" placeholder="MasterGamesStu2" value="{{ isset($settings) == true ? $settings->profile_twitter : '' }}" />
                </div>
                <div class="form-group">
                    <label for="twitterImg">Twitter Image</label>
                    <input type="url" class="form-control" id="twitterImg" name="twitter_img" placeholder="URL" value="{{ isset($settings) == true ? $settings->twitter_img : '' }}" required />
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
