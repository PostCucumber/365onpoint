<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    public function a_guest_should_be_redirected_to_login_page()
    {
        $response = $this->get('/');

        $response->assertStatus(302);

        $response = $this->get('/resident');

        $response->assertStatus(302);

        $response = $this->get('/transaction');

        $response->assertStatus(302);

    }

    /** @test */
    public function a_logged_in_user_should_be_able_to_navigate_freely()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response = $this->get('/');

        $response->assertStatus(200);

        $response = $this->get('/resident');

        $response->assertStatus(200);

        $response = $this->get('/transaction');

        $response->assertStatus(200);
    }



}
