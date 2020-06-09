<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use App\User;
use App\Settings;

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
        $settings = Settings::find(1);
        return view('dashboard.index', compact('settings'));
    }

    /**
     * Show the application posts.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function posts() 
    {
        $posts = Posts::orderByDesc('created_at')->simplePaginate(10);
        $settings = Settings::find(1);
        return view('dashboard.posts',  compact('posts', 'settings'));
    }
}
