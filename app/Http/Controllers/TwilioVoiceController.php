<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TwilioVoiceController extends Controller
{
    public function index(Request $request){
        $data = $request->all();
        $calls = $this->twilio->calls
                ->read([], 20);

        foreach ($calls as $record) {
            print($record->sid);
        }
    }
}
