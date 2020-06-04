<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard.index');
    }

    /**
     * Show the application posts.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function posts() 
    {
        $blog_posts = Posts::orderByDesc('created_at')->where('online', true)->simplePaginate(10);

        return view('dashboard.posts',  [
            'posts' => $blog_posts
        ]);
    }
}
