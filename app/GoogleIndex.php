<?php

namespace App;

use Google_Client;
use Google_Service_Indexing;
use Google_Service_Indexing_UrlNotification;
use Google_Service_Webmasters;

class GoogleIndex
{
    /** @var Google_Client */
    private $googleClient;

    /** @var Google_Service_Indexing */
    private $indexingService;

    /** @var Google_Service_Webmasters */
    private $webMasterService;

    public function __construct()
    {
        $this->googleClient = new Google_Client();

        $this->googleClient->setAuthConfig(config('services.googleAPI.auth_config'));

        foreach (config('services.googleAPI.auth_config', []) as $scope) {
            $this->googleClient->addScope($scope);
        }

        $this->indexingService = new Google_Service_Indexing($this->googleClient);
        $this->webMasterService = new Google_Service_Webmasters($this->googleClient);
    }

    public static function create(): self
    {
        return new static();
    }

    public function status(string $url)
    {
        return $this->indexingService
            ->urlNotifications
            ->getMetadata([
                'url' => urlencode($url),
            ]);
    }

    public function update(string $url)
    {
        return $this->publish($url, 'URL_UPDATED');
    }

    public function delete(string $url)
    {
        return $this->publish($url, 'URL_DELETED');
    }

    private function publish(string $url, string $action)
    {
        $urlNotification = new Google_Service_Indexing_UrlNotification();

        $urlNotification->setUrl($url);
        $urlNotification->setType($action);

        return $this->indexingService
            ->urlNotifications
            ->publish($urlNotification);
    }

    public function sitemap(string $url)
    {
        return $this->webMasterService->sites->get($url);
    }

}
