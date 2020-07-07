<?php

namespace App\Http\Controllers;

use App\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource (general settings).
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Settings::find(1);
        return view('dashboard.settings.index', compact('settings'));
    }

    /**
     * Display a listing of the resource (mobile settings).
     *
     * @return \Illuminate\Http\Response
     */
    public function mobile()
    {
        $settings = Settings::find(1);
        return view('dashboard.settings.mobile', compact('settings'));
    }

    /**
     * Display a listing of the resource (social networks settings).
     *
     * @return \Illuminate\Http\Response
     */
    public function social()
    {
        $settings = Settings::find(1);
        return view('dashboard.settings.social', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function show(Settings $settings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function edit(Settings $settings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:60',
            'short_title' => 'required|string|max:32',
            'description' => 'required|string|max:160',
            'google_tag' => 'string|max:13',
        ]);

        $settings = Settings::find($id);
        $settings->title = $request->title;
        $settings->short_title = $request->short_title;
        $settings->description = $request->description;
        $settings->icon_fav = $request->icon_fav;
        $settings->google_tag = $request->google_tag;
        $settings->icon_apple = $request->icon_apple;
        $settings->theme_color = $request->theme_color;
        $settings->profile_facebook = $request->profile_facebook;
        $settings->profile_twitter = $request->profile_twitter;
        $settings->save();

        return redirect()->back()->with('notification', 'Settings are updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Settings $settings)
    {
        //
    }
}
