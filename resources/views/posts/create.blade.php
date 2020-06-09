@extends('layouts.dashboard')

@section('content')
<h1 class="mb-4">{{ isset($post) == false ? "New Post" : "Edit Post" }}</h1>

<div class="container-fluid mb-5">
    <div class="row">
        <div class="col shadow bg-white w-100">
        @if(empty($post ?? ''))
            <form class="bp-create-form p-4" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @else
            <form class="bp-create-form p-4" action="{{ route('posts.update', $post ?? '') }}" method="POST" enctype="multipart/form-data">
        @endif
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ isset($post) == true ? $post->title : '' }}" required />
                </div>
                <div class="form-group">
                    <label for="coverImage">Cover Image</label>
                    <input type="url" class="form-control" id="coverImage" name="cover_img" placeholder="http://imgur.com/" value="{{ isset($post) == true ? $post->cover_img : '' }}" required/>
                </div>
                <div class="form-group">
                    <label for="isOnline">Online?</label>
                    <select class="form-control" id="isOnline" name="online">
                        <option value="1" {{ (isset($post) == true && $post->online == 1) ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ (isset($post) == true && $post->online == 0) ? 'selected' : '' }}>No</option>
                    </select>
                </div>
                <div class="form-group mt-4">
                    <label for="articleSummary">Article Summary</label>
                    <textarea class="form-control" id="articleSummary" name="summary">{{ isset($post) == true ? $post->summary : old('summary') }}</textarea>
                </div>
                <div class="form-group mt-4">
                    <label for="articleText">Article</label>
                    <textarea class="form-control" id="articleText" name="body">{{ isset($post) == true ? $post->body : old('body') }}</textarea>
                </div>

                <div class="float-right py-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                {!! app('captcha')->render(); !!}
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('/js/tinymce.min.js') }}"></script>

<script>
function onArticleTextChange(currentEditor) {
    
    tinymce.get('articleSummary').setContent(currentEditor.getContent().split("\n")[0]);
}

// Initialise editors
tinymce.init({
    selector: '#articleText',
    skin: 'bootstrap',
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen autosave',
        'insertdatetime media table paste code help wordcount'
    ],
    toolbar: 'undo redo restoredraft | formatselect fontselect | ' +
        'bold italic backcolor | alignleft aligncenter alignright alignjustify' +
        '| link image media ' +
        '| bullist numlist outdent indent | removeformat',
    autosave_restore_when_empty: true,
    autosave_retention: "60m",
    setup: (ed) => {
        ed.on("input propertychange", () => {
            onArticleTextChange(ed);
        })
    }
});

tinymce.init({
    selector: '#articleSummary',
    skin: 'bootstrap',
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen autosave',
        'insertdatetime media table paste code help wordcount'
    ],
    toolbar: 'undo redo restoredraft | formatselect fontselect | ' +
        'bold italic backcolor | alignleft aligncenter alignright alignjustify' +
        '| link image media ' +
        '| bullist numlist outdent indent | removeformat',
    autosave_restore_when_empty: true,
    autosave_retention: "60m"
});
</script>
@endsection
