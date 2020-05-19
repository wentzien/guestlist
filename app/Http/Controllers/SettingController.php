<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = User::find(auth()->id());
        return view('setting', ['setting' => $setting]);
    }

    public function update()
    {
        \request()->validate([
            'gastro_name' => ['required', 'unique:users'],
        ]);

        $user = User::find(auth()->id());

        $user->gastro_name = \request('gastro_name');
        $user->welcome_heading = \request('welcome_heading');
        $user->welcome_text= \request('welcome_text');
        $user->save();

        return redirect('settings');
    }
}
