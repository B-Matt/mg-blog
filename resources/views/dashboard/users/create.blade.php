@extends('layouts.dashboard')

@section('extra-css')
@endsection

@section('content')
<h1 class="mb-4">{{ isset($user) == false ? "New User" : "Edit User" }}</h1>

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="m-0 pl-4 pr-4 pt-2 pb-2">
        @foreach ($errors->all() as $error)
            <li class="text-white">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="container-fluid mb-5">
    <div class="row">
        <div class="col shadow bg-white w-100">
        @if(empty($user ?? ''))
            <form class="bp-create-form p-4" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @else
            <form class="bp-create-form p-4" action="{{ route('users.update', $user ?? '') }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
        @endif        
                @csrf
                <div class="form-group">
                    <label for="user-name">{{ __('main.name') }}</label>
                    <input type="text" class="form-control" id="user-name" name="name" placeholder="John Doe" value="{{ isset($user) == true ? $user->name : old('name') }}" required />
                </div>
                <div class="form-group">
                    <label for="user-mail">{{ __('main.email') }}</label>
                    <input type="email" class="form-control" id="user-mail" name="email" placeholder="john.doe@themastetgames.com" value="{{ isset($user) == true ? $user->email : old('email') }}" required/>
                </div>
                <div class="form-group">
                    <label for="user-password">{{ __('main.password') }}</label>
                    <div class="form-inline">
                        <div id="bp-pw-toggle" class="col form-inline pl-0">
                            <input type="password" class="col form-control" id="user-password" name="password" placeholder="••••••" value="" autocomplete="new-password"/>
                            <div class="bp-group-addon">
                                <a href="#">
                                    <i class="dash-icon flaticon-vision" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        <a href="#" id="bp-pwgn-btn" class="btn btn-primary">{{ __('main.generate') }}</a>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password-confirm">{{ __('main.confirm_pass') }}</label>
                    <div id="bp-pw-toggle">
                        <input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="••••••" autocomplete="new-password"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="user-avatar">{{ __('main.avatar_img') }}</label>
                    <input type="url" class="form-control" id="user-avatar" name="avatar" placeholder="http://imgur.com/" value="{{ isset($user) == true ? $user->avatar : old('avatar') }}" />
                </div>
                <div class="form-group">
                    <label for="user-about">{{ __('main.user_about') }}</label>
                    <span class="text-muted float-right d-inline-flex mr-3">
                        Language:

                        <?php $locales = config('mgblog.avaliable_locales') ?>
                        <div class="ml-2 dropdown">
                            <a href="" class="dropdown-toggle" type="button" id="localeDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                {{ $locales[0]['name'] }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="localeDropdown">
                                @foreach($locales as $locale)
                                    <li><a href="#" class="pl-3" data-value="{{ $locale['locale'] }}">{{ $locale['name'] }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </span>
                    @foreach($locales as $locale)
                        <textarea class="form-control" id="user-about-{{ $locale['locale'] }}" name="about[]">{{ isset($user) == true ? $user->translations['about'][$locale['locale']] : old('about[$loop->index]') }}</textarea>
                    @endforeach
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


@section('extra-js')
<script src="{{ asset('/js/jquery.slim.min.js') }}"></script>
@endsection

@section('js-code')
<script>
    $(document).ready(function() {

        // Password generation
        function generatePassword() {

            const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            const length = 10, n = charset.length;
            let password = "";

            for (let i = 0; i < length; i++) {

                password += charset.charAt(Math.floor(Math.random() * n));
            }
            return password;
        }

        $("#bp-pwgn-btn").click(function(event) {

            event.preventDefault();
            const pw = generatePassword();

            $("#user-password").val(pw);
            $("#password-confirm").val(pw);
        });

        // Show/hide password
        $("#bp-pw-toggle a").on('click', function(event) {
            event.preventDefault();
            if($('#bp-pw-toggle input').attr("type") == "text"){
                $('#bp-pw-toggle input').attr('type', 'password');
                $('#bp-pw-toggle i').addClass( "flaticon-vision" );
                $('#bp-pw-toggle i').removeClass( "flaticon-vision-1" );
            }else if($('#bp-pw-toggle input').attr("type") == "password"){
                $('#bp-pw-toggle input').attr('type', 'text');
                $('#bp-pw-toggle i').removeClass( "flaticon-vision" );
                $('#bp-pw-toggle i').addClass( "flaticon-vision-1" );
            }
        });

        // Locale menu
        $("#user-about-en").show();
        $("#user-about-hr").hide();

        $(".dropdown-menu li a").click(function(event) {

            event.preventDefault();
            const value = $(this).data('value');
            $(this).parents(".dropdown").find('.dropdown-toggle').html($(this).text() + ' <span class="caret"></span>');
            $(this).parents(".dropdown").find('.dropdown-toggle').val(value);

            if(value == "en") {

                $("#user-about-en").show();
                $("#user-about-hr").hide();
            }
            else if(value == "hr") {

                $("#user-about-hr").show();
                $("#user-about-en").hide();
            }
        });
    });
</script>
@endsection