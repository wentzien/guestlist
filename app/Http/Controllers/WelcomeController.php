<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function show($gastro_name = null)
    {
        if ($gastro_name != null) {
            $welcome_data = DB::table('users')->where('gastro_name', $gastro_name)->first();

            $link = $this->checkData($welcome_data, $gastro_name);

            return view("welcome", [
                'link' => $link
            ]);
        } else {
            return view("welcome", [
                'link' => '/recording'
            ]);
        }
    }

    function checkData($welcome_data, $gastro_name = null)
    {
        if ($welcome_data->welcome_heading != "" && $welcome_data->welcome_text != "") {
            return "/recording/" . $gastro_name;
        } else {
            return "/recording";
        }
    }


}
