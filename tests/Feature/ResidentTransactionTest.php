<?php

namespace Tests\Feature;

use App\Resident;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ResidentTransactionTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_should_get_the_total_balance_for_a_resident()
    {
        $resident = factory('App\Resident')->create();
        factory('App\Transaction', 2)->create([
            'resident_id' => $resident->id,
            'debit'       => 0,
            'credit'      => 10
        ]);

        $this->assertEquals(20, Resident::totalBalance($resident->id));
    }
}