<?php

namespace App\Http\Controllers;

use Auth;
use GitDown;

use App\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog_posts = Posts::orderByDesc('created_at')->where('online', true)->paginate(10);

        return view('posts.index', [
            'posts' => $blog_posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);
        dd($request);

        $author = Auth::user();
        $post = new Posts;

        $post->title = $request->title;
        $post->slug = Str::slug($post->title, '-');
        $post->cover_img = $request->cover_img;
        //$post->body_md = $request->body;
        $post->body_html = $request->body; //GitDown::parseAndCache($request->body);
        //$post->summary_md = $request->summary;
        $post->summary_html = $request->summary; //GitDown::parseAndCache($request->summary); 
        $post->online = $request->online;
        $post->author()->associate($author);
        $post->save();

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  String  $param
     * @return \Illuminate\Http\Response
     */
    public function show($param)
    {
        $post = Posts::where('id', $param)->orWhere('slug', $param)->firstOrFail();
        if($post->online) {
            return view('posts.show', [
                'post' => $post
            ]);
        }
        return redirect()->route('posts.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function edit(Posts $posts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Posts $posts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posts $posts)
    {
        //
    }
}
