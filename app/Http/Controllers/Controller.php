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
        $this->token = '27bceb352670e9be406f02b6a8b8dacd';
        $this->twilio_number = '+12029331442';
        $this->twilio = new Client($this->sid, $this->token);
    }

}
