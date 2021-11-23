<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Todo;

class IndexTodoTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function show_all_todo_test()
    {
        $todo = Todo::factory()->create([
            "name" => "TEST NAME",
            "description" => "TEST DESCRIPTION"
        ]);

        $response = $this->getJson(route("todo.index"));

        $response->assertOk();   //test that we got a successful response.

        $this->assertCount(1, $response->json());

        $this->assertEquals("TEST NAME", $response->json()[0]);
        $this->assertEquals("TEST DESCRIPTION", $response->json()[1]);
    }
}
