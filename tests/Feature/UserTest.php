<?php

// use Illuminate\Foundation\Testing\RefreshDatabase;

// uses(RefreshDatabase::class);

test('test user registration', function () {
    $testUser = [
        "name" => "Test User",
        "email" => "testuser@email.com",
        "password" => "123456789"
    ];

    $response = $this->post('/register', $testUser);

    $response->assertStatus(302);

    $this->assertDatabaseHas('users', [
        'email' => 'testuser@email.com',
    ]);
});
