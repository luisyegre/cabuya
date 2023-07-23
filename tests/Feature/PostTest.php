<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use DatabaseMigrations, DatabaseTransactions;
    public function test_create_post()
    {
        $this->post('api/auth/login', [
            'email' => 'test1@email.com',
            'password' => '123',
        ]);
        $response = $this->post('api/posts', [
            'body' => 'hola como estan ?'
        ]);
        $response->assertStatus(201);
    }
    public function test_index_post()
    {
        $response = $this->get('api/posts');

        $response->assertStatus(200);
    }
}
