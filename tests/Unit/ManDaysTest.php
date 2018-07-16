<?php

namespace Tests\Unit;

use App\Resident;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ManDaysTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function one_day_equals_one_man_day_for_one_resident()
    {
        //create a resident
        $knownDate = Carbon::create(2017, 1, 1, 0);
        Carbon::setTestNow($knownDate);

        $resident = factory(Resident::class)->create([
            'date_of_admission'        => new Carbon(),
            'actual_date_of_discharge' => Carbon::parse($knownDate->addDays(1))
        ]);


        //calculate man days
        $manDays = Resident::calculateManDays($resident);


        //Assert man days are correct

        self::assertEquals(1, $manDays);


    }

    /** @test */
    public function one_day_equals_two_man_days_for_two_residents()
    {
        //create a resident
        $knownDate = Carbon::create(2017, 1, 1, 0);
        Carbon::setTestNow($knownDate);

        $residents = factory(Resident::class, 2)->create([
            'date_of_admission'        => new Carbon(),
            'actual_date_of_discharge' => Carbon::parse($knownDate->addDays(1))
        ]);


        //calculate man days
        $manDays = 0;
        foreach ($residents as $resident) {
            $manDays += Resident::calculateManDays($resident);
        }


        //Assert man days are correct

        self::assertEquals(2, $manDays);

    }

    /** @test */
    public function man_days_should_not_count_date_of_discharge()
    {
        $date     = Carbon::now();
        $resident = factory(Resident::class)->create([
            'date_of_admission'        => $date,
            'actual_date_of_discharge' => $date->addDay()
        ]);

        $manDays = Resident::calculateManDays($resident);

        self::assertEquals(1, $manDays);


    }

    /** @test */
    public function first_day_should_be_counted()
    {
        $date = Carbon::now();

        $resident = factory(Resident::class)->create([
            'date_of_admission'        => $date,
            'actual_date_of_discharge' => null
        ]);
        $manDays = Resident::calculateManDays($resident);

        self::assertEquals(1, $manDays);
    }


}
