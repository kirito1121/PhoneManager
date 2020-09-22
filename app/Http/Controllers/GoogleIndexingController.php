<?php

namespace App\Http\Controllers;

use App\GoogleIndex;
use App\Jobs\GoogleApiIndexing;
use Google_Client;
use Google_Http_Batch;
use Google_Service_Indexing;
use Google_Service_Indexing_UrlNotification;
use Google_Service_Webmasters;
use Google_Service_Webmasters_SearchAnalyticsQueryRequest;
use Illuminate\Support\Facades\Log;

class GoogleIndexingController extends Controller
{
    public function update(){
        // $urls = [
        //     "https://pridecouple.com/product/on-a-dark-desert-highway-hippie-girl-donkey-unisex-tank-top/",
        //     "https://pridecouple.com/product/coast-guard-veteran-dd-214-alumni-unisex-tank-top/",
        //     "https://pridecouple.com/product/coast-guard-veteran-dd-214-alumni-unisex-long-sleeve/",
        //     "https://pridecouple.com/product/coast-guard-veteran-dd-214-alumni-crewneck-sweatshirt/"
        // ];
        $url = "https://pridecouple.com/product/the-earths-environment-and-i-think-what-a-wonderful-world-unisex-long-sleeve/";
        $api = new GoogleIndex;
        $rep = $api->update($url);
        return response()->json($rep);

        // $client = new Google_Client();

        // // service_account_file.json is the private key that you created for your service account.
        // $client->setAuthConfig(config('services.googleAPI.auth_config'));
        // $client->addScope('https://www.googleapis.com/auth/indexing');

        // // Get a Guzzle HTTP Client
        // $httpClient = $client->authorize();
        // $endpoint = 'https://indexing.googleapis.com/v3/urlNotifications:publish';

        // // Define contents here. The structure of the content is described in the next step.
        // $content = '{
        //     "url": "https://pridecouple.com/product/on-a-dark-desert-highway-hippie-girl-donkey-unisex-tank-top/",
        //     "type": "URL_UPDATED"
        // }';

        // $response = $httpClient->post($endpoint, [ 'body' => $content ]);
        // $status_code = $response->getStatusCode();
        // return response()->json($response);
        // $i = 1;
        // foreach ($urls as $item) {
        //     $job = (new GoogleApiIndexing($item))->delay(now()->addMinutes($i+=5));
        //     $this->dispatch($job);
        //     Log::info($i);
        // }
        // GoogleApiIndexing::dispatch($url);

    }
    public function index(){

        $url = "https://pridecouple.com/product/coast-guard-uscg-american-w-crewneck-sweatshirt";
        $api = new GoogleIndex;
        $rep = $api->status($url);
        return response()->json($rep);

    }

    public function getSiteMap(){
        $client = new Google_Client();
        $client->setAuthConfig(config('services.googleAPI.auth_config'));
        $client->addScope( 'https://www.googleapis.com/auth/webmasters' );

        $serviceWebmasters = new Google_Service_Webmasters( $client );
        $response = $serviceWebmasters->sitemaps->submit("https://pridecouple.com/","https://pridecouple.com/product-sitemap4.xml");
        // $postBody = new Google_Service_Webmasters_SearchAnalyticsQueryRequest( [
        //     'startDate'  => '2020-09-01',
        //     'endDate'    => '2020-10-30',
        //     'dimensions' => [
        //         'query'
        //     ],
        //     'rowLimit' => 500,
        //     'startRow' => 0
        // ] );
        // $response = $serviceWebmasters->searchanalytics->query( "http://pridecouple.com" , $postBody );
        var_dump($response);
    }
}
