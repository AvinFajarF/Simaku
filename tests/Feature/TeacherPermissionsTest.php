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
        $response = $this->postJson(
            '/api/v1/teacher/permission/create',
            [
                'name' => 'mr.test',
                "date" => "2020-01-01",
                "class" => "X",
                "at_hour" => "10",
                "type" => "dinas",
                "room" => "1",
                "task_instruction" => "test instruction",
                "task_file" => "test file",
                "permission_letter" => "test permission later"
            ]
        );

        $response
            ->assertStatus(201)
            ->assertJson([
                "status" => "success",
                "message" => "managed to create permission"
            ]);
    }
}
