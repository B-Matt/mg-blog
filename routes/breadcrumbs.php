<?php
Breadcrumbs::for('index', function ($trail) {
    $trail->push('Index', route('index'));
});

// Posts
Breadcrumbs::for('posts.index', function ($trail) {
    $trail->parent('index');
    $trail->push('Posts', route('posts.index'));
});

// Posts > [Post Name]
Breadcrumbs::for('post', function ($trail, $post) {
    $trail->parent('posts.index');
    $trail->push($post->title, route('posts.show', $post->id));
});