<?php

namespace Tests\Feature;

use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use DatabaseMigrations, DatabaseTransactions;
    static $userData = [
        'email' => 'test1@email.com',
        'password' => '123'
    ];
    // protected UserFactory $factory;
    // public function setUp(): void
    // {
    //     parent::setUp();
    //     $this->factory = new UserFactory();
    //     if (self::$userData == null) {
    //         self::$userData = $this->factory->definition();
    //     }
    // }
    public function test_show_data()
    {
        $this->post('api/auth/login', [
            'email' => self::$userData['email'],
            'password' => self::$userData['password'],
        ]);
        $response = $this->get('api/users/profile');
        $response->assertStatus(200);
    }
}
