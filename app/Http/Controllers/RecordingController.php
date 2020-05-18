<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RecordingController extends Controller
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

        } else {
            //ansonsten Standartwerte
            return view("recording", [
                'welcome_heading' => 'Liebe Gäste,',
                'welcome_text' => 'auf Grund der aktuellen Corona-Auflagen sind wir verpflichtet Ihre Kontaktdaten zu erfassen. Bitte sprechen Sie gleich, wenn der rote Punkt erscheint Ihren Namen und wie Sie zu erreichen sind. Vielen Dank!',
                'text_to_speech' => 'Liebe Gäste, auf Grund der aktuellen Corona-Auflagen sind wir verpflichtet ihre Kontaktdaten zu erfassen. Bitte sprechen sie gleich, wenn der rote Punkt erscheint ihren Namen und wie sie zu erreichen sind. Vielen Dank.'
            ]);
        }
    }
}
