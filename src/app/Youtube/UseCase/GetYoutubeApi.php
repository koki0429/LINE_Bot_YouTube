<?php

namespace App\Youtube\UseCase;

use Google_Client;
use Google_Service_YouTube;
use Illuminate\Support\Facades\Log;

class GetYoutubeApi
{
    public function __construct()
    {
        $key = config('services.google.api_key');
        Log::debug($key);

        $client = new Google_Client();
        $client->setDeveloperKey($key);
        $youtube = new Google_Service_YouTube($client);

        return $youtube;
    }
}
