@extends('layouts.dashboard')

@section('extra-css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
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
            <form class="bp-create-form p-3" action="{{ route('posts.store', app()->getLocale()) }}" method="POST" enctype="multipart/form-data">
            @else
            <form class="bp-create-form p-3" action="{{ route('posts.update', ['locale' => app()->getLocale(), 'post' => $post ?? '']) }}"  method="POST" enctype="multipart/form-data">
                @method('PATCH')
            @endif
                @csrf

                <span class="text-muted float-right d-inline-flex mr-3">
                    Language:
                    <?php $locales = config('mgblog.avaliable_locales') ?>
                    <div class="ml-2 dropdown">
                        <a href="" class="dropdown-toggle" type="button" id="bp-locale-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            {{ $locales[0]['name'] }} <span class="caret"></span>
                        </a>
                        <ul id="bp-locale-menu" class="dropdown-menu" aria-labelledby="bp-locale-dropdown">
                            @foreach($locales as $locale)
                            <li><a href="#" class="pl-3" data-value="{{ $locale['locale'] }}">{{ $locale['name'] }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </span>

                <div class="form-group">
                    @foreach($locales as $locale)
                    <input type="text" class="form-control bp-title-inputs" id="title-{{ $locale['locale'] }}"
                        data-value="{{ $locale['locale'] }}" name="title[]" placeholder="{{ __('main.title') }}"
                        value="{{ isset($post) == true ? $post->translations['title'][$locale['locale']] : old('title[$loop->index]') }}" />
                    @endforeach
                </div>
                <div class="form-group mt-4">
                    @foreach($locales as $locale)
                    <textarea class="form-control bp-textarea bp-body-inputs" id="articleText-{{ $locale['locale'] }}" name="body[{{ $loop->index }}]" data-value="{{ $locale['locale'] }}">{{ isset($post) == true ? $post->translations['body'][$locale['locale']] : old('body[$loop->index]') }}</textarea>
                    @endforeach
                </div>
                <div class="form-group text-center">
                    <div class="bp-cover-prvw">
                        <img src="{{ isset($post) == true ? $post->cover_img : old('cover_img') }}" class="img-fluid" id="bp-cover-img" alt="Blog post cover image" />
                        <button type="button" id="bp-cover-change" class="btn btn-outline-primary float-right">Change image</button>
                    </div>
                    <input type="hidden" class="form-control" id="bp-cover-img-url" name="cover_img" placeholder="{{ __('main.cover') }}" value="{{ isset($post) == true ? $post->cover_img : old('cover_img') }}" />
                    <button role="button" class="btn bp-set-cover-img" data-toggle="modal" data-target="#bp-cover-mod">Set cover image</button>
                </div>
                <div class="form-group">
                    <label for="isOnline">{{ __('main.online') }}</label>
                    <select class="form-control" id="isOnline" name="online">
                        <option value="1" {{ (isset($post) == true && $post->online == 1) ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ (isset($post) == true && $post->online == 0) ? 'selected' : '' }}>No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="postTags">{{ __('main.tags') }}</label>
                    <select class="form-control bp-select" id="postTags" name="tags[]" multiple="multiple">
                    @foreach($tags as $tag)
                        @if(isset($post_tags) == true)
                            @if(in_array($tag->name, $post_tags))
                                <option selected="selected">{{ $tag->name }}</option>
                            @else
                                <option>{{ $tag->name }}</option>
                            @endif
                        @else
                            <option>{{ $tag->name }}</option>
                        @endif                        
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="postCategory">{{ __('main.category') }}</label>
                    <select class="form-control" id="postCategory" name="category" required>
                    @foreach($categories as $category)
                        @if(isset($post_category) == true)
                            @if($category->slug == $post_category[0]["slug"])
                                <option value="{{ $category->slug }}" selected="selected">{{ $category->name }}</option>
                            @else
                                <option value="{{ $category->slug }}">{{ $category->name }}</option>
                            @endif
                        @else
                            <option value="{{ $category->slug }}">{{ $category->name }}</option>
                        @endif                         
                    @endforeach
                    </select>
                </div>
                <div class="float-right py-3">
                    <button type="submit" id="bp-submit-btn" class="btn btn-primary">{{ __('main.submit') }}</button>
                </div>
                {!! app('captcha')->render(); !!}
            </form>
        </div>
    </div>
</div>

<div class="modal" id="bp-cover-mod" tabindex="-1" role="dialog" aria-labelledby="bp-cover-mod-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="bp-cover-mod-title" class="modal-title">Cover image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="url" id="bp-cover-mod-url" class="bp-mod-input w-100" placeholder="{{ __('main.cover') }} URL" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary bp-cover-mod-set" disabled>Set cover image</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" defer></script>
<script src="{{ asset('/js/ckeditor/ckeditor.js') }}" defer></script>
@endsection

@section('js-code')
<script>
    $(document).ready(() => {

        $(".bp-select").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });

        // Locales
        let bodyEditor = null,
            bodyTextArea = null;

        $(".bp-title-inputs").each((index, element) => {

            if (index == 0) {
                $(element).show();
            } else {
                $(element).hide();
            }
        });

        $(".bp-body-inputs").each((index, element) => {

            if (index == 0) {

                $(element).show();
                CKEDITOR.replace($(element).attr('id'), {
                    customConfig: "{{ asset('/js/ckeditor/config.js') }}"
                });
            } else {
                $(element).hide();
            }
        });

        $("#bp-locale-menu li a").click((e) => {

            e.preventDefault();
            const value = $(e.currentTarget).data('value');
            $(e.currentTarget).parents(".dropdown").find('.dropdown-toggle').html($(e.currentTarget).text() + ' <span class="caret"></span>');
            $(e.currentTarget).parents(".dropdown").find('.dropdown-toggle').val(value);

            $(".bp-title-inputs").each(function (index, element) {

                $(element).hide();
                if ($(element).data('value') == value) {
                   
                    $(element).show();
                }
            });

            $(".bp-body-inputs").each(function (index, element) {

                if(CKEDITOR.instances[$(element).attr('id')] !== undefined) {
                    CKEDITOR.instances[$(element).attr('id')].updateElement();
                    CKEDITOR.instances[$(element).attr('id')].destroy();
                }

                if ($(element).data('value') == value) {

                    $(element).show();
                    bodyTextArea = element;
                    CKEDITOR.replace($(element).attr('id'), {
                        customConfig: ''
                    });                 
                } else {
                    $(element).hide();
                }
            });
        });

        // Cover Image
        if($("#bp-cover-img").attr("src").length <= 0) {
            $(".bp-cover-prvw").hide();
        } else {
            $(".bp-set-cover-img").hide();
        }
        

        $(".bp-set-cover-img").click((e) => {

            e.preventDefault();
        });

        // Cover Image Modal
        $("#bp-cover-mod-url").keyup(() => {
            
            const input = $("#bp-cover-mod-url").val();
            const regexCheck = /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/|www\.)[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;
            $(".bp-cover-mod-set").attr("disabled", !regexCheck.test(input));
        });

        $(".bp-cover-mod-set").click(() => {

            const input = $("#bp-cover-mod-url").val();
            $("#bp-cover-img").attr("src", input);
            $("#bp-cover-img-url").val(input);

            $(".bp-set-cover-img").hide();
            $("#bp-cover-mod").modal('hide');
            $(".bp-cover-prvw").show();            
        });

        $("#bp-cover-change").click(() => {

            const input = $("#bp-cover-img-url").val();
            $("#bp-cover-mod-url").text(input);
            $("#bp-cover-mod").modal('show');
        });
    });

</script>
@endsection
