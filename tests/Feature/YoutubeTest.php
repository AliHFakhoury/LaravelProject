<?php

test('test YoutubeAPI', function () {
    $videoTitle = [
        "videoTitle" => "Test"
    ];

    $response = $this->get('/api/youtubeAPI/search', $videoTitle);

    $response->assertStatus(200);
});
