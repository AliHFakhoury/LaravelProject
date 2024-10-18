<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Service\Youtube;
use Google\Client;

class YoutubeController extends Controller {
    protected $youtubeService;

    public function __construct(){
        $client = new Client();
        $client->setApplicationName("My First Project");
        $client->setDeveloperKey(env("YOUTUBE_API_KEY"));
        
        $this->youtubeService = new Youtube($client);
    }

    public function search(Request $request){
        $videoTitle = $request["videoTitle"];

        $params = [
            'q' => $videoTitle,
            'maxResults' => 10
        ];

        $response = $this->youtubeService->search->listSearch('snippet', $params);

        return response()
        ->json($response)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, X-Auth-Token, Origin, Authorization');
    }
}