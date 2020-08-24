<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Twilio\Jwt\ClientToken;
use Twilio\Rest\Client;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        // $this->sid = env("TWILIO_SID");
        $this->sid = "ACd40df911a63cea4375b1a8166a443a5e";
        // $this->token = env("TWILIO_TOKEN");
        $this->token = "7fbe3cf4b142ebd1cd4fb58228a7d3ea";
        $this->twilio_number = '+12029331442';
        $this->twilio = new Client($this->sid, $this->token);
        $this->clientToken = new ClientToken($this->sid, $this->token);

    }

}
