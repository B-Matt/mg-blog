<?php

namespace App\Http\Controllers;

use App\Posts;
use Rinvex\Categories\Models\Category;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        $posts = Posts::all()->first();
        $categories = Category::all()->first();
        $tags = Posts::existingTags();

        return response()->view('sitemap.index', compact('posts', 'categories', 'tags'))->header('Content-Type', 'text/xml');
    }

    public function posts()
    {
        $posts = Posts::latest()->get();
        return response()->view('sitemap.posts', compact('posts'))->header('Content-Type', 'text/xml');
    }

    public function categories()
    {
        $categories = Category::all();
        return response()->view('sitemap.categories', compact('categories'))->header('Content-Type', 'text/xml');
    }

    public function tags()
    {
        $tags = Posts::existingTags();
        return response()->view('sitemap.tags', compact('tags'))->header('Content-Type', 'text/xml');
    }
}
