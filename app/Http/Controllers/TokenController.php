<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TokenController extends Controller
{

    public function newToken(Request $request)
    {
        $forPage = $request->input('forPage') ?? "voice";

        $this->clientToken->allowClientOutgoing($this->sid);

        if ($forPage === "voice") {
            $this->clientToken->allowClientIncoming('support_agent');
        } else {
            $this->clientToken->allowClientIncoming('customer');
        }
        // if ($forPage === route('voice', [], false)) {
        //     $this->clientToken->allowClientIncoming('support_agent');
        // } else {
        //     $this->clientToken->allowClientIncoming('customer');
        // }
        $token = $this->clientToken->generateToken();
        return response()->json(['token' => $token]);
    }
}
