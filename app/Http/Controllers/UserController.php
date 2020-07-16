<?php

namespace App\Http\Controllers;

use App\User;
use App\Settings;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderByDesc('created_at')->paginate(10);
        $settings = Settings::find(1);
        return view('dashboard.users.index', compact('users', 'settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $settings = Settings::find(1);
        return view('dashboard.users.create', compact('settings'));
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
            'name' => 'required|string|max:32|unique:users',
            'email' => 'required|string|email:rfc,dns|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'avatar' => 'required|url',
            'about.*' => 'required|string|min:8',
        ]);
        $user = new User;

        $user->name = $request->name;
        $user->avatar = $request->avatar;

        $locales = config('mgblog.avaliable_locales');
        $translations = [
            $locales[0]['locale'] => $request->about[0]
        ];

        for($i = 1, $len = count($locales); $i < $len; $i++)
        {
            $temp = [$locales[$i]['locale'] => $request->about[$i]];
            $translations = array_merge($translations, $temp);
        }

        $user->setTranslations('about', $translations);
        $user->email = $request->email;
        $user->password = Hash::make($request->pass);
        $user->save();

        return redirect()->route('users.index')->with('notification', 'User <strong>' . $user->name .  '</strong> is successfuly created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $settings = Settings::find(1);
        return view('dashboard.users.create', compact('user', 'settings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:32',
            'email' => 'required|string|email:rfc,dns',
            'password' => "",
            'avatar' => 'required|url',
            'about.*' => 'required|string|min:8',
        ]);

        $data["about"] = $this->format_locale_str($request->about);

        // Password is not updated
        if(empty($data["password"]))
        {
            $data["password"] = $user->password;
        }
        $user->update($data);
        return redirect()->route('users.index')->with('notification', 'User <strong>' . $user->name .  '</strong> is updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('notification', 'User <strong>' . $user->name .  '</strong> is deleted!');
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
}
