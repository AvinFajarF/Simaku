<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeacherJournalsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_create_journals(): void
    {
        $token = "1|kEnxZWzkEl37m1ngA0hlzaOVNKj1NbFq6Geciv9I";

        $response = $this->postJson(
            '/api/v1/teacher/journals',
            [
                'name' => 'mr.test',
                "date" => "2020-01-01",
                "class" => "X",
                "at_hour" => "10",
                "subject" => "create journals",
                "description" => "test description",
                "student_note" => "test note",
                "subject_id" => "1"
            ],
            [
                'Authorization' => 'Bearer '. $token
            ]
        );

        $response
            ->assertStatus(201)
            ->assertJson([
                "status" => "success",
                "message" => "managed to create Journal"
            ]);
    }


    public function test_create_fail_journals(): void
    {
        $token = "1|kEnxZWzkEl37m1nghlzaOVNKj1NbFq6Geciv9I";

        $response = $this->postJson(
            '/api/v1/teacher/journals',
            [
                'name' => 'mr.test',
                "date" => "2020-01-01",
                "class" => "X",
                "at_hour" => "10",
                "subject" => "create journals",
                "description" => "test description",
                "student_note" => "test note",
                "subject_id" => "1"
            ],
            [
                'Authorization' => 'Bearer '. $token
            ]
        );

        $response
        ->assertStatus(401)
        ->assertJson([
            "message" => "Unauthenticated."
        ]);
    }


}
