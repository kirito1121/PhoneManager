<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\TwiML\VoiceResponse;

class TwilioVoiceController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->all();
        $calls = $this->twilio->calls
            ->read($data);

        foreach ($calls as $record) {
            array_push($data, [
                "direction"=> $record->direction,
                "duration"=> $record->duration,
                "from"=> $record->from,
                "to"=> $record->to,
                "sid"=> $record->sid,
                "status"=> $record->status,
                "start_time"=> $record->startTime,
                "end_time"=> $record->endTime,
                "date_created"=> $record->dateCreated,
                "date_updated"=> $record->dateUpdated,
            ]);
        }
        return $data;
    }

    public function get(Request $request)
    {
        $record = $this->twilio->calls($request->sid)->fetch();
        $data = [
            "direction"=> $record->direction,
            "duration"=> $record->duration,
            "from"=> $record->from,
            "to"=> $record->to,
            "sid"=> $record->sid,
            "status"=> $record->status,
            "start_time"=> $record->startTime,
            "end_time"=> $record->endTime,
            "date_created"=> $record->dateCreated,
            "date_updated"=> $record->dateUpdated,
        ];
        return $data;
    }

    public function call(Request $request)
    {
        $this->twilio->account->calls->create(
            $request->to,
            $this->twilio_number,
            array(
                "url" => "http://demo.twilio.com/docs/voice.xml"
            )
        );
    }
}
