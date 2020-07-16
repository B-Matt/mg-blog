<?php

namespace App\Http\Controllers;

use Auth;

use App\Posts;
use App\Settings;
use Rinvex\Categories\Models\Category;
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
        $post = null;

        return view('posts.index', compact('post', 'posts', 'settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $settings = Settings::find(1);
        $tags = Posts::existingTags();
        $categories = Category::get();
        return view('posts.create', compact('settings', 'tags', 'categories'));
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
            'title.*' => 'required|min:2|max:64',
            'cover_img' => 'required',
            'body.*' => 'required|min:8',
        ]);

        $author = Auth::user();
        $post = new Posts;

        $post->setTranslations('title', $this->format_locale_str($request->title));
        $post->setTranslations('body', $this->format_locale_str($request->body));
        $post->setTranslations('slug', $this->format_locale_slug($request->title));

        $post->cover_img = $request->cover_img;
        $post->online = $request->online;
        $post->author()->associate($author);
        
        $post->save();
        $post->tag($request->tags);
        $post->attachCategories([$request->category]);

        return redirect()->route('dash.posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  String $locale
     * @param  String  $param
     * @return \Illuminate\Http\Response
     */
    public function show($locale, $param)
    {
        $post = Posts::where('id', $param)->orWhere('slug->' . $locale, $param)->firstOrFail();
        if($post->online || Auth::check())
        {
            $settings = Settings::find(1);
            $post_category = $post->categories;
            return view('posts.show', compact('post', 'settings', 'post_category'));
        }
        return redirect()->route('posts.index', app()->getLocale());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  String      $locale
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, Posts $post)
    {
        $settings = Settings::find(1);
        $tags = Posts::existingTags();
        $post_tags = [];
        foreach($post->tags as $tag) 
        {
            $post_tags[] = $tag->name;
        }

        $categories = Category::get();
        $post_category = $post->categories->toArray();
        
        return view('posts.create', compact('post', 'settings', 'tags', 'post_tags', 'categories', 'post_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  String $locale
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Posts  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $locale, Posts $post)
    {
        $request->validate([
            'title.*' => 'required|min:2|max:64',
            'cover_img' => 'required',
            'body.*' => 'required|min:8',
        ]);

        $data = $request->except(['tags']);
        $data["title"] = $this->format_locale_str($request->title);
        $data["slug"] = $this->format_locale_slug($request->title);
        $data["body"] = $this->format_locale_str($request->body);

        $post->update($data);
        $post->retag($request->tags);
        $post->syncCategories([$request->category], true);

        return redirect()->route('dash.posts');
    }

    /**
     * Shows all posts tagged with certain tag.
     * 
     * @param String $locale
     * @param String $tag
     * @return \Illuminate\Http\Response
     */
    public function tagged($locale, $tag) {

        $posts = Posts::withAnyTag($tag)->paginate(10);
        $settings = Settings::find(1);
        return view('posts.index', compact('posts', 'settings'));
    }

    /**
     * Shows all posts in certain category.
     * 
     * @param String $locale
     * @param String $tag
     * @return \Illuminate\Http\Response
     */
    public function category($locale, $category) {

        $posts = Posts::withAnyCategories([$category])->paginate(10);
        $settings = Settings::find(1);
        return view('posts.index', compact('posts', 'settings'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Posts  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale, Posts $post)
    {
        $post->delete();
        return redirect()->route('dash.posts')->with('notification', 'Blog post titled <strong>' . $post->title .  '</strong> is deleted!');
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

    /**
     * Formats JSON string from input array used for localization.
     */
    private function format_locale_str($input)
    {
        $locales = config('mgblog.avaliable_locales');
        $translations = [
            $locales[0]['locale'] => $input[0]
        ];

        for($i = 1, $len = count($locales); $i < $len; $i++)
        {
            $temp = [$locales[$i]['locale'] => $input[$i]];
            $translations = array_merge($translations, $temp);
        }
        return $translations;
    }

    /**
     * Formats JSON string from input array used for localization.
     */
    private function format_locale_slug($input)
    {
        $locales = config('mgblog.avaliable_locales');
        $translations = [
            $locales[0]['locale'] => Str::slug($input[0], '-')
        ];

        for($i = 1, $len = count($locales); $i < $len; $i++)
        {
            $temp = [$locales[$i]['locale'] => Str::slug($input[$i], '-')];
            $translations = array_merge($translations, $temp);
        }
        return $translations;
    }
}
