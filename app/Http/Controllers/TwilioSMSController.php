<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TwilioSMSController extends Controller
{
    /**
     * Lấy danh sách sms đến và đi
     *
     */

    public function index(Request $request)
    {
        $data = $request->all();
        $messages = $this->twilio->messages->read($data);
        $data = [];
        foreach ($messages as $record) {
            array_push($data, [
                "body" => $record->body,
                "direction" => $record->direction,
                "from" => $record->from,
                "status" => $record->status,
                "to" => $record->to,
                "date_sent" => $record->dateSent,
                "sid" => $record->sid,
            ]);
        }
        return $data;
    }
    /**
     * Send sms
     *
     */
    public function post(Request $request)
    {
        $this->twilio->messages->create(
            $request->phone,
            array(
                'from' => $this->twilio_number,
                'body' => $request->body,
            )
        );
    }
    /**
     * Send sms
     *
     */
    public function get(Request $request)
    {
        $record = $this->twilio->messages($request->sid)->fetch();
        $data = [
            "body" => $record->body,
            "direction" => $record->direction,
            "from" => $record->from,
            "status" => $record->status,
            "to" => $record->to,
            "date_created" => $record->dateCreated,
            "date_sent" => $record->dateSent,
            "date_updated" => $record->dateUpdated,
            "sid" => $record->sid,
        ];
        return $data;
    }

}
