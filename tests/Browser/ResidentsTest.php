<?php

namespace Tests\Browser;

use App\Resident;
use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ResidentsTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_signed_in_user_can_see_the_residents_page()
    {
        factory(User::class)->create([
            'facility' => 'Demo'
        ]);

        $resident = factory(Resident::class)->create([
            'facility' => 'Demo'
        ]);

        $this->browse(function (Browser $first) use ($resident) {
            $first->loginAs(User::find(1))
                ->visit('/resident')
                ->assertSee($resident->last_name);
        });
    }

    /** @test */
    public function a_signed_in_user_can_see_the_single_resident_page()
    {
        factory(User::class)->create([
            'facility' => 'Demo'
        ]);

        $resident = factory(Resident::class)->create([
            'facility' => 'Demo'
        ]);

        $this->browse(function (Browser $first) use ($resident) {
            $first->loginAs(User::find(1))
                ->visit('/resident/' . $resident->id)
                ->assertPathIs('/resident/' . $resident->id)
                ->assertSee($resident->last_name);
        });
    }
}
