<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     * @depends UserApiTest
     */
    use DatabaseMigrations, DatabaseTransactions;
    static $userData = [
        'name' => 'test user',
        'email' => 'test1@email.com',
        'password' => '123'
    ];
    public function test_register_user()
    {
        $response = $this->post('api/auth/register', self::$userData);
        $response->assertStatus(201);
    }
    public function test_already_register_user()
    {
        $response = $this->post('api/auth/register', self::$userData);
        $response->assertStatus(400);
    }
    public function test_auth()
    {
        $response = $this->post('api/auth/login', [
            'email' => 'test@email.com',
            'password' => '123',
        ]);
        $response->assertStatus(200);
    }
}
