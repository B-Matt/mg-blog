@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-10 shadow bg-white">
            <form class="bp-create-form p-4" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                </div>
                <div class="form-group">
                    <label for="coverImage">Cover Image</label>
                    <input type="url" class="form-control" id="coverImage" name="cover_img"
                        placeholder="http://imgur.com/">
                </div>
                <div class="form-group">
                    <label for="isOnline">Online?</label>
                    <select class="form-control" id="isOnline">
                        <option>Yes</option>
                        <option>No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="articleSummary">Article Summary</label>
                    <textarea class="form-control" id="articleSummary" name="summary">{{ old('summary') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="articleText">Article</label>
                    <textarea class="form-control" id="articleText" name="body">{{ old('body') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

{{-- Import CSS and JS for SimpleMDE editor --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>

<script>
    // Initialise editors
    var bodyEditor = new SimpleMDE({
        element: document.getElementById("articleText")
    });
    var summaryEditor = new SimpleMDE({
        element: document.getElementById("articleSummary")
    });

</script>

@endsection
