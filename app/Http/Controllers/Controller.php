<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Twilio\Rest\Client;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        // $this->sid = env("TWILIO_SID");
        $this->sid = "ACd40df911a63cea4375b1a8166a443a5e";
        // $this->token = env("TWILIO_TOKEN");
        $this->token = "93a94bf7b265561d34108786aa88b6f6";
        $this->twilio_number = '+12029331442';
        $this->twilio = new Client($this->sid, $this->token);
    }

}
