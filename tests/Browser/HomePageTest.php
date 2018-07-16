<?php

namespace Tests\Browser;

use App\Resident;
use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class HomePageTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_signed_in_user_can_see_the_homepage()
    {
        factory(User::class)->create([
            'facility' => 'Demo'
        ]);

        $this->browse(function (Browser $first) {
            $first->loginAs(User::find(1))
                ->visit('/')
                ->assertSee('Demo Dashboard');
        });
    }

}
