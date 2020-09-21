<?php

namespace App\Http\Controllers;

use App\GoogleIndex;
use Google_Client;
use Google_Service_Webmasters;

class GoogleIndexingController extends Controller
{
    public function update(){
        $url = "http://www.usastatesshop.com/product_tag-sitemap.xml";
        $api = new GoogleIndex;
        $rep = $api->update($url);
        return response()->json($rep);
    }

    public function getSiteMap(){
        // $url = "http://www.usastatesshop.com";
        // $api = new GoogleIndex;
        // $site = $api->sitemap($url);
        // return response()->json($site);

        $client = new Google_Client();

        // service_account_file.json is the private key that you created for your service account.
        $client->setAuthConfig(config('services.googleAPI.auth_config'));
        $client->addScope('https://www.googleapis.com/auth/webmasters');

        $service = new Google_Service_Webmasters($client);
        $t = $service->sites->get('http://www.usastatesshop.com');
        return response()->json($t);

    }
}
