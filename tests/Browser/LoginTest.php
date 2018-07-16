<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Chrome;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;
    /** @test */
    public function it_has_a_login_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Username');
        });
    }

    /** @test */
    public function a_username_is_required_to_login()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('username', '')
                ->type('password', 'secret')
                ->press('Login')
                ->assertSee('The username field is required');
        });
    }

    /** @test */
    public function a_password_is_required_to_login()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('username', 'john')
                ->type('password', '')
                ->press('Login')
                ->assertSee('The password field is required');
        });
    }

    /** @test */
    public function a_user_can_login()
    {
        $user = factory(User::class)->create([
            'username' => 'john',
            'facility' => 'Demo'
        ]);


        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                ->type('username', $user->username)
                ->type('password', 'secret')
                ->press('Login')
                ->assertPathIs('/')
                ->assertSee('Demo Dashboard');
        });
    }

}
