<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function show($gastro_name = null)
    {
        if (auth()->check()) {
            $welcome_data = User::find(auth()->id());

            return view("recording", [
                'welcome_heading' => $welcome_data->welcome_heading,
                'welcome_text' => $welcome_data->welcome_text,
                'text_to_speech' => $welcome_data->welcome_heading." ".$welcome_data->welcome_text
            ]);
        } elseif ($gastro_name != null) {
            $welcome_data = DB::table('users')->where('gastro_name', $gastro_name)->first();
            if($welcome_data){
                return view("recording", [
                    'welcome_heading' => $welcome_data->welcome_heading,
                    'welcome_text' => $welcome_data->welcome_text,
                    'text_to_speech' => $welcome_data->welcome_heading." ".$welcome_data->welcome_text
                ]);
            }else{
                return $this->show(null);
            }
        } else {
            //ansonsten Standartwerte
            return view("recording");
        }
    }
}
