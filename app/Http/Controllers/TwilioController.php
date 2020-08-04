<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class TwilioController extends Controller
{


    function __construct()
    {
        $this->sid = 'ACd40df911a63cea4375b1a8166a443a5e';
        $this->token = '737f5ead1dff6551f9d5ba6efc625a47';
        $this->twilio_number = '+15017122661';
        $this->twilio = new Client($this->sid, $this->token);
    }


    /**
     * Lấy danh sách sms đến và đi
     *
     */
    public function index(){
        $messages = $this->twilio->messages->read();

        $data = [];

        foreach ($messages as $record) {
            array_push($data,[
                "body"=> $record->body,
                "direction"=> $record->direction,
                "from"=> $record->from,
                "status"=> $record->status,
                "to"=> $record->to,
                "date_created"=> $record->dateCreated,
                "date_sent"=>$record->dateSent,
                "date_updated"=> $record->dateUpdated,
            ]);
        }
        return $data;
    }
    /**
     * Send sms
     *
     */
    public function post(Request $request){
        $this->twilio->messages->create(
            // Where to send a text message (your cell phone?)
            $request->phone,
            array(
                'from' => $this->twilio_number,
                'body' => 'I sent this message in under 10 minutes!'
            )
        );
    }

}
