<?php

namespace Tests\Unit;

use App\Resident;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ResidentTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_should_handle_all_date_formats_for_dob()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);


        $residentArray = [
            'last_name'                   => 'Adkins',
            'first_name'                  => 'Daron',
            'middle_initial'              => 'J',
            'sex'                         => 'M',
            'race'                        => 'White',
            'document_number'             => '25225',
            'service_center_number'       => '225522',
            'dob'                         => '03/01/1987',
            'age'                         => '32',
            'drug'                        => 'Weed',
            'date_of_admission'           => '2012-06-01',
            'projected_date_of_discharge' => '2012-06-01',
            'actual_date_of_discharge'    => null,
            'status'                      => 'Successful',
            'status_at_discharge'         => null,
            'counselor'                   => 'Williams',
            'program_level'               => 'I',
            'employment_date'             => null,
            'payment_method'              => 'WWJD',
            'referral_source'             => 'Testing'
        ];

        $response = $this->post('/resident', $residentArray);
        $response->assertSeeText("Success");

    }

    /** @test */
    public function it_should_create_a_resident()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $resident = factory(Resident::class)->create();

        $this->assertEquals(Resident::first()->id, $resident->id);
    }

    /** @test */
    public function it_should_edit_a_resident()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $resident = factory(Resident::class)->create();
        $this->assertEquals(1, $resident->id);

        $resident->update([
            'last_name' => 'Changed'
        ]);

        $this->assertEquals(1, $resident->id);
        $this->assertEquals('Changed', $resident->last_name);
    }
}
