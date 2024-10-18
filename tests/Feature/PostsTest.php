<?php

use App\Models\Post;

test('test getPosts', function () {
    $response = $this->get('/api/getPosts');

    $response->assertStatus(200);
});

test('test createPost', function () {
    // Would be in a different test database, not the live one.
    $postToCreate = [
        'title' => 'test',
        'body' => 'test',
    ];
    
    $postToCreate['user_id'] = "1";

    $response = $this->post('/api/createPost', $postToCreate);
    
    $response->assertStatus(200);
});

test('test getPost', function () {
    $response = $this->get('/api/getPost/2');
    
    $response->assertStatus(200);
});