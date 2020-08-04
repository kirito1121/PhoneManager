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

    function __construct()
    {
        $this->sid = 'ACd40df911a63cea4375b1a8166a443a5e';
        $this->token = 'b7b3800601ac37034c825bcab64ce3bb';
        $this->twilio_number = '+15017122661';
        $this->twilio = new Client($this->sid, $this->token);
    }

}
