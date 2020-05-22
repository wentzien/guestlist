<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecordingController extends Controller
{
    public function show($gastro_name = null)
    {
        if ($gastro_name != null) { //check ob individueller Text unter der URL enthalten ist

            $welcome_data = DB::table('users')->where('gastro_name', $gastro_name)->first();
            return $this->checkData($welcome_data, $gastro_name);

        } else {

            if (auth()->check()) { //wenn eingeloggt, wird versucht den individuellen Text zu verwenden

                $welcome_data = User::find(auth()->id());
                return $this->checkData($welcome_data);

            } else {
                //ansonsten Standartwerte
                return $this->checkData();
            }
        }
    }

    function checkData($welcome_data, $link = null)
    {
        $default_heading = "Liebe Gäste,";
        $default_text = "auf Grund der aktuellen Corona-Auflagen sind wir verpflichtet Ihre Kontaktdaten zu erfassen. Bitte sprechen Sie gleich, wenn der rote Punkt erscheint Ihren Namen und wie Sie zu erreichen sind. Vielen Dank!";
        $default_text_to_speech = $default_heading . " " . $default_text;

        if ($welcome_data->welcome_heading != "" && $welcome_data->welcome_text != "") {
            return view("recording", [
                'welcome_heading' => $welcome_data->welcome_heading,
                'welcome_text' => $welcome_data->welcome_text,
                'text_to_speech' => $welcome_data->welcome_heading . " " . $welcome_data->welcome_text,
                'link' => '/welcome/'.$link,
            ]);
        } else {
            return view('recording', [
                'welcome_heading' => $default_heading,
                'welcome_text' => $default_text,
                'text_to_speech' => $default_text_to_speech,
                'link' => '/welcome/'.$link,
            ]);
        }
    }
}
