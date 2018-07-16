<?php

namespace Tests\Feature;

use App\Resident;
use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ManDaysForMonthTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_should_calculate_all_man_days_for_specified_month()
    {
        $user = factory(User::class)->create([
            'facility' => 'Demo'
        ]);

        $this->actingAs($user);

        $firstDate  = Carbon::create(2017, 1, 1, 12);
        $secondDate = Carbon::create(2017, 1, 2, 12);

        factory(Resident::class)->create([
            'date_of_admission'        => $firstDate->toDateString(),
            'actual_date_of_discharge' => null,
            'facility'                 => $user->facility
        ]);

        factory(Resident::class)->create([
            'date_of_admission'        => $secondDate->toDateString(),
            'actual_date_of_discharge' => null,
            'facility'                 => $user->facility
        ]);
        factory(Resident::class)->create([
            'date_of_admission'        => $secondDate->toDateString(),
            'actual_date_of_discharge' => null,
            'facility'                 => $user->facility
        ]);


        $manDays = Resident::calculateManDaysForMonth($firstDate->year, $firstDate->month);


        self::assertEquals(91, $manDays);
    }

    /** @test */
    public function it_should_calculate_man_days_for_current_month()
    {
        $user = factory(User::class)->create([
            'facility' => 'Demo'
        ]);

        $this->actingAs($user);

        $admitDate     = Carbon::now()->firstOfMonth()->toDateString();
        $dayOfTheMonth = Carbon::now()->day;
        factory(Resident::class)->create([
            'date_of_admission'        => $admitDate,
            'actual_date_of_discharge' => null,
            'facility'                 => $user->facility
        ]);
        factory(Resident::class)->create([
            'date_of_admission'        => $admitDate,
            'actual_date_of_discharge' => null,
            'facility'                 => $user->facility
        ]);

        $manDays = Resident::calculateManDaysForCurrentMonth();


        self::assertEquals($dayOfTheMonth * 2, $manDays);

    }

    /** @test */
    public function it_should_calculate_man_days_for_fiscal_year()
    {
        $user = factory(User::class)->create([
            'facility' => 'Demo'
        ]);

        $this->actingAs($user);

        $admitDate   = Carbon::create(2017, 5, 1);
        $releaseDate = Carbon::createFromDate(2017, 5, 30);


        factory(Resident::class)->create([
            'date_of_admission'        => $admitDate,
            'actual_date_of_discharge' => $releaseDate,
            'facility'                 => $user->facility
        ]);

        $manfy = Resident::calculateManDaysForFiscalYear(2017, 5);

        self::assertEquals(29, $manfy);
    }

}
