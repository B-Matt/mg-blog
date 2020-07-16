<?php

namespace App\Http\Controllers;

use App\Settings;
use App\Posts;
use Rinvex\Categories\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Settings::find(1);
        $categories = Category::get();
        return view('dashboard.settings.category', compact('settings', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Category::create(['name' => ['en' => $request->name], 'description' => $request->description, 'slug' => $request->slug]);
        return redirect()->route('categories.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|numeric',
            'slug' => 'sometimes|unique:categories|max:255',
            'name' => 'required|max:255',
            'description' => 'required|max:255'
        ]);

        $category = Category::find($data["id"]);
        $category->update(['name' => ['en' => $data["name"]], 'description' => $data["description"], 'slug' => isset($data["slug"]) ? $data["slug"] : $category->slug]);
        return response()->json('<strong>' . $data["name"] .  '</strong> category is updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $name = $category->name;
        $category->delete();
        
        return redirect()->route('categories.index')->with('notification', '<strong>' . $name .  '</strong> category is deleted!');
    }
}
