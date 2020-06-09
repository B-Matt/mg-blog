<?php

namespace App\Http\Controllers;

use Auth;

use App\Posts;
use App\Settings;
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
        $posts = Posts::orderByDesc('created_at')->where('online', true)->paginate(10);
        $settings = Settings::find(1);
        return view('posts.index', compact('posts', 'settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $settings = Settings::find(1);
        return view('posts.create', 'settings');
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
            'title' => 'required|unique:posts|max:255',
            'cover_img' => 'required',
        ]);

        $author = Auth::user();
        $post = new Posts;       

        $post->title = $request->title;
        $post->slug = Str::slug($post->title, '-');
        $post->cover_img = $request->cover_img;
        $post->body = str_replace("background-color: #ffffff;", "", $request->body);
        $post->summary = str_replace("background-color: #ffffff;", "", $request->summary);
        $post->online = $request->online;
        $post->author()->associate($author);
        $post->save();

        return redirect()->route('dash.posts');
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
        if($post->online || Auth::check()) {
            $settings = Settings::find(1);
            return view('posts.show', compact('post', 'settings'));
        }
        return redirect()->route('posts.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function edit(Posts $post)
    {
        $settings = Settings::find(1);
        return view('posts.create', compact('post', 'settings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Posts  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Posts $post)
    {
        $request->validate([
            'title' => 'required',
            'cover_img' => 'required',
        ]);

        $request->slug = Str::slug($request->title, '-');
        $post->update($request);
        return redirect()->route('dash.posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Posts  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posts $post)
    {
        $post->delete();
        return redirect()->route('dash.posts')->with('notification', 'Blog post titled <strong>' . $post->title .  '</strong> is deleted!');;
    }

    /**
     * Toogles specified resource visibility.
     * 
     * @param  \App\Posts  $post
     * @return \Illuminate\Http\Response
     */
    public function visibility(Request $request, Posts $post)
    {
        $post->online = $request->visibility;
        $post->save();        
        return redirect()->route('dash.posts');
    }
}
