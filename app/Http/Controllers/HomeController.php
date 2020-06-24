<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Posts;
use App\User;
use App\Settings;

class HomeController extends Controller
{
    /**
     * Redirects to index page with locale.
     */
    public function redirect()
    {
        return redirect(app()->getLocale()); 
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
        $slugs = [];

        for($i = 0, $len = count($posts); $i < $len; $i++) 
        {
            $slugs[$posts[$i]->id] = array_values($posts[$i]->translations['slug']);
        }
        return view('dashboard.posts',  compact('posts', 'settings', 'slugs'));
    }
}
