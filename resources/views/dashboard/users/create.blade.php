@extends('layouts.dashboard')

@section('content')
<h1 class="mb-4">{{ isset($post) == false ? "New User" : "Edit User" }}</h1>

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
        @if(empty($post ?? ''))
            <form class="bp-create-form p-4" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @else
            <form class="bp-create-form p-4" action="{{ route('users.update', $post ?? '') }}" method="POST" enctype="multipart/form-data">
        @endif        
                @csrf
                <div class="form-group">
                    <label for="user-name">Name</label>
                    <input type="text" class="form-control" id="user-name" name="name" placeholder="John Doe" value="{{ isset($user) == true ? $user->name : old('name') }}" required />
                </div>
                <div class="form-group">
                    <label for="user-mail">E-Mail</label>
                    <input type="email" class="form-control" id="user-mail" name="email" placeholder="john.doe@themastetgames.com" value="{{ isset($user) == true ? $user->email : old('email') }}" required/>
                </div>
                <div class="form-group">
                    <label for="user-password">Password</label>
                    <div class="form-inline">
                    <input type="password" class="col mr-3 form-control" id="user-password" name="password" placeholder="••••••" value="{{ isset($user) == true ? $user->password : '' }}" autocomplete="new-password"/>
                    <a href="#" id="bp-pwgn-btn" class="btn btn-primary">Generate</a>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password-confirm">Confirm password</label>
                    <input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="••••••" required autocomplete="new-password"/>
                </div>
                <div class="form-group">
                    <label for="user-avatar">Avatar Image</label>
                    <input type="url" class="form-control" id="user-avatar" name="avatar" placeholder="http://imgur.com/" value="{{ isset($user) == true ? $user->avatar : old('avatar') }}" />
                </div>
                <div class="form-group">
                    <label for="user-about">About user</label>
                    <textarea class="form-control" id="user-about" name="about">{{ isset($user) == true ? $post->about : old('about') }}</textarea>
                </div>
                <div class="float-right py-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                {!! app('captcha')->render(); !!}
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('/js/jquery.slim.min.js') }}"></script>

<script>
$(document).ready(function() {

    function generatePassword() {

        const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        const length = 10, n = charset.length;
        let password = "";

        for (let i = 0; i < length; i++) {

            password += charset.charAt(Math.floor(Math.random() * n));
        }
        return password;
    }

    $("#bp-pwgn-btn").click(function() {

        const pw = generatePassword();
        $("#user-password").val(pw);
        $("#password-confirm").val(pw);
    });
});
</script>
@endsection
