<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\FacilityInfo;
use App\Note;
use App\Resident;
use App\Transaction;
use App\User;
use Carbon\Carbon;

$factory->define(User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'username'       => $faker->unique()->userName,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'facility'       => $faker->randomElement(['Panama City', 'Orlando', 'Tallahassee'])
    ];
});

$factory->define(FacilityInfo::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'facility_name'       => 'Demo',
        'contractor_name'     => $faker->company,
        'street_address'      => $faker->address,
        'fein_number'         => $faker->bankAccountNumber,
        'contract_number'     => $faker->bankAccountNumber,
        'max_annual_bed_days' => 219000,
        'per_diem'            => 4750
    ];
});

$factory->define(Resident::class, function (Faker\Generator $faker) {

    $startDate = Carbon::createFromTimeStamp($faker->dateTimeBetween('-6 months', 'now')->getTimestamp());
    $endDate   = Carbon::createFromFormat('Y-m-d H:i:s', $startDate)->addMonth();

    return [
        'age'                         => $faker->randomNumber(2),
        'dob'                         => $faker->date(),
        'sex'                         => $faker->randomElement($array = array('M', 'F')),
        'drug'                        => $faker->randomElement($array = array('Cocaine', 'Alcohol', 'Cannabis', 'Amphetamines', 'Barbiturates', 'Poly Substance', 'Opiates', 'Morphine', 'LSD')),
        'race'                        => $faker->randomElement($array = array('White', 'Native Hawaiian or Other Pacific Islander', 'Black or African American', 'Asian', 'American Indian or Alaskan Native', 'Hispanic or Latino')),
        'email'                       => $faker->safeEmail,
        'status'                      => $faker->randomElement($array = array('DOP', 'Prob', 'PDO', 'CC', 'County', 'Federal')),
        'employer'                    => $faker->company,
        'facility'                    => $faker->randomElement(['Panama City', 'Tallahassee', 'Orlando']),
        'counselor'                   => $faker->lastName,
        'last_name'                   => $faker->lastName,
        'first_name'                  => $faker->firstName(),
        'program_level'               => $faker->randomElement($array = array('I', 'II')),
        'middle_initial'              => $faker->randomLetter,
        'payment_method'              => $faker->randomElement($array = array('Nonsecure', 'DOC Funded', 'DOC Self Pay', 'WCFDI Self Pay', 'DOC Co-Pay', 'County Self Pay', 'Federal Self Pay')),
        'document_number'             => $faker->bothify('##########'),
        'referral_source'             => $faker->randomElement($array = array('DOC', 'WCFDI', 'County', 'Federal')),
        'employment_date'             => $faker->date(),
        'date_of_admission'           => $faker->dateTimeBetween($startDate, $endDate),
        'status_at_discharge'         => $faker->randomElement($array = array('Successful', 'Unsuccessful - Abscond', 'Unsuccessful - Disciplinary', 'Administrative')),
        'service_center_number'       => $faker->bothify('########'),
        'actual_date_of_discharge'    => $faker->dateTimeBetween('-1 year', 'now'),
        'projected_date_of_discharge' => $faker->date(),
    ];
});
$factory->define(Transaction::class, function (Faker\Generator $faker) {

    return [
//        'resident_id' => factory('App\Resident')->create()->id,
        'date'   => $faker->date('Y-m-d'),
        'reason' => $faker->randomElement($array = array('Urinalysis', 'Rides', 'Anger Management', 'Physical', 'Payment', 'Sustenance')),
        'debit'  => $faker->numberBetween(0, 10000),
        'credit' => $faker->numberBetween(0, 10000),
    ];
});

$factory->define(Note::class, function (Faker\Generator $faker) {

    return [
//        'resident_id' => factory('App\Resident')->create()->id,
        'date'       => $faker->date('Y-m-d'),
        'note'       => $faker->words(15, true),
        'updated_by' => 1
    ];
});
