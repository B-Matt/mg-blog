@extends('layouts.dashboard')

@section('notification')
{!! \Session::get('notification') !!}
@endsection

@section('content')
<div class="d-inline-flex mb-4">
    <h1>General settings</h1>
</div>

<div class="container-fluid mb-5">
    <div class="row">
        <div class="col w-100">
            <form class="bp-create-form p-4" action="{{ route('settings.update', $settings ?? '') }}" method="POST" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Full Blog Name" value="{{ isset($settings) == true ? $settings->title : '' }}" required />
                </div>
                <div class="form-group">
                    <label for="short-title">Short Title</label>
                    <input type="text" class="form-control" id="short-title" name="short_title" placeholder="Post Title &bull; Blog" value="{{ isset($settings) == true ? $settings->short_title : '' }}" required />
                </div>
                <div class="form-group">
                    <label for="short-title">Description</label>
                    <input type="text" class="form-control" id="short-title" name="description" placeholder="Lorem ipsum..." value="{{ isset($settings) == true ? $settings->description : '' }}" required />
                </div>
                <div class="form-group">
                    <label for="iconFav">Favicon</label>
                    <input type="url" class="form-control" id="iconFav" name="icon_fav" placeholder="http://imgur.com/" value="{{ isset($settings) == true ? $settings->icon_fav : '' }}" />
                </div>
                <div class="form-group">
                    <label for="iconApple">Favicon</label>
                    <input type="url" class="form-control" id="iconApple" name="icon_apple" placeholder="http://imgur.com/" value="{{ isset($settings) == true ? $settings->icon_apple : '' }}" />
                </div>
                <div class="form-group">
                    <label for="themeColor">Theme Color</label>
                    <input type="text" class="form-control" id="themeColor" name="theme_color" placeholder="#ffffff" value="{{ isset($settings) == true ? $settings->theme_color : '' }}" />
                </div>

                <div class="float-right py-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                {!! app('captcha')->render(); !!}
            </form>
        </div>
    </div>
</div>
@endsection
