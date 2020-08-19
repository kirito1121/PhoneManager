<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Twilio\TwiML\VoiceResponse;

class TwilioVoiceController extends Controller
{
    /**
     * Read list voice call
     *
     */
    public function index(Request $request)
    {
        $rq = $request->all();

        if (isset($rq['startTime'])) {
            $rq['startTime'] = new DateTime($rq['startTime']);
        }
        if (isset($rq['endTime'])) {
            $rq['endTime'] = new DateTime($rq['endTime']);
        }
        if (isset($rq['startTimeAfter'])) {
            $rq['startTimeAfter'] = new DateTime($rq['startTimeAfter']);
        }
        if (isset($rq['startTimeBefore'])) {
            $rq['startTimeBefore'] = new DateTime($rq['startTimeBefore']);
        }

        $calls = $this->twilio->calls
            ->read($rq);
        $data = [];
        foreach ($calls as $record) {
            array_push($data, [
                "direction" => $record->direction,
                "duration" => $record->duration,
                "from" => $record->from,
                "to" => $record->to,
                "sid" => $record->sid,
                "status" => $record->status,
                "start_time" => $record->startTime,
                "end_time" => $record->endTime,
                "date_created" => $record->dateCreated,
                "date_updated" => $record->dateUpdated,
                "subresource_uris" => $record->subresourceUris,
            ]);
        }
        return $data;
    }

    /**
     * Get a record
     *
     */

    public function get(Request $request)
    {
        $record = $this->twilio->calls($request->sid)->fetch();
        $data = [
            "direction" => $record->direction,
            "duration" => $record->duration,
            "from" => $record->from,
            "to" => $record->to,
            "sid" => $record->sid,
            "status" => $record->status,
            "start_time" => $record->startTime,
            "end_time" => $record->endTime,
        ];
        return $data;
    }

    /**
     * Voice Call
     *
     */

    public function call(Request $request)
    {
        $call = $this->twilio->account->calls->create(
            $request->to,
            $this->twilio_number,
            array(
                "record" => true,
                "url" => "http://demo.twilio.com/docs/voice.xml",
                "twiml" => "<Response><Say>Ahoy there!</Say></Response>"
            )
        );
    }

    /**
     * Record voice inbound
     *
     */

    public function receive(Request $request)
    {
        Log::info("vao day roi");
        $response = new VoiceResponse();
        $response->dial('(202) 933-1442');
        $response->say('Please leave a message at the beep');
        $response->record();
    }
    /**
     * Read the recording voice call
     *
     */
    public function recordingVoice(Request $request)
    {
        $recordings = $this->twilio->recordings
            ->read(["callSid" => $request->sid]);
        foreach ($recordings as $record) {
            return ($record->sid);
        }
    }

    public function fetchRecording(Request $request)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://api.twilio.com/2010-04-01/Accounts/ACd40df911a63cea4375b1a8166a443a5e/Recordings/$request->re.mp3");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_USERPWD, 'ACd40df911a63cea4375b1a8166a443a5e' . ':' . '27bceb352670e9be406f02b6a8b8dacd');
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return $result;
    }
}
