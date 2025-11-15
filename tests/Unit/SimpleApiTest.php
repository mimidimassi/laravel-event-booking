<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SimpleApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */






     public function test_organizer_can_create_event()
    {
        // Create an organizer user
        $organizer = User::factory()->create(['role' => 'organizer']);
        $token = $organizer->createToken('api')->plainTextToken;

        // Send POST request to create event
        $response = $this->withHeader('Authorization', "Bearer $token")
                         ->postJson('/api/events', [
                             'title' => 'Sample Event',
                             'description' => 'Test Description',
                             'date' => '2025-12-01',
                             'location' => 'Test Location',
                         ]);

        $response->assertStatus(201)
                 ->assertJsonFragment(['title' => 'Sample Event']);
    }
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
