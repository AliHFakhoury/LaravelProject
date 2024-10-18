<?php

namespace App\Services;

use Google\Client;
use Google\Service\Youtube;

class YoutubeService {
    protected $youtube;

    public function __construct(){
        $client = new Client();
        $client->setApplicationName("My First Project");
        $client->setDeveloperKey(config("YOUTUBE_API_KEY"));
        
        $this->youtube = new Youtube($client);
    }

    public function searchVideos($query, $maxResults=10){
       $params = [
        'q' => $query,
        'type' => 'video',
        'maxResults' => $maxResults
       ];

       $response = $this->youtube->search->listSearch('snippet', $params);

       return $response->getItems();
    }
}