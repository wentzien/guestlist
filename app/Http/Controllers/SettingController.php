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
        $user = auth()->user()->getAttribute("id");


        dump(\request()->all());
    }
}
