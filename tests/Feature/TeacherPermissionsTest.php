<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeacherPermissionsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_create_permission(): void
    {
        $response = $this->postJson('/api/v1/teacher/permission/create', ['name' => 'Sally']);

        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);
    }
}
