<?php

use App\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'adminpc',
            'name'     => 'Panama City Administrator',
            'email'    => 'npipc@keetoncorrections.com',
            'password' => bcrypt(env('PC_ADMIN_PASSWORD')),
            'facility' => 'Panama City'

        ]);
        User::create([
            'username' => 'admintally',
            'name'     => 'Tallahassee Administrator',
            'email'    => 'npitall@keetoncorrections.com',
            'password' => bcrypt(env('TALLAHASSEE_ADMIN_PASSWORD')),
            'facility' => 'Tallahassee'

        ]);
        User::create([
            'username' => 'adminpcola',
            'name'     => 'Pensacola Admin',
            'email'    => 'npipcola@keetoncorrections.com',
            'password' => bcrypt(env('PENSACOLA_ADMIN_PASSWORD')),
            'facility' => 'Pensacola'

        ]);
        User::create([
            'username' => 'adminocala',
            'name'     => 'Ocala Admin',
            'email'    => 'npiocala@keetoncorrections.com',
            'password' => bcrypt(env('OCALA_ADMIN_PASSWORD')),
            'facility' => 'Ocala'

        ]);
        User::create([
            'username' => 'adminorlando',
            'name'     => 'Orlando Admin',
            'email'    => 'prcorlando@keetoncorrections.com',
            'password' => bcrypt(env('ORLANDO_ADMIN_PASSWORD')),
            'facility' => 'Orlando'

        ]);

        User::create([
            'username' => 'daron',
            'name'     => 'Daron Adkins',
            'email'    => 'daron.adkins@gmail.com',
            'password' => bcrypt('23wesdxc'),
            'facility' => 'Demo'
        ]);
        User::create([
            'username' => 'stefan',
            'name'     => 'Stefan Grantcharov',
            'email'    => 'usahsllc@aol.com',
            'password' => bcrypt('0nPoint'),
            'facility' => 'Demo'
        ]);

        User::create([
            'username' => 'karen',
            'name'     => 'Karen Hall',
            'email'    => 'vpo@keetoncorrections.com',
            'password' => bcrypt('Demo123'),
            'facility' => 'Demo'
        ]);

        User::create([
            'username' => 'dylan',
            'name'     => 'Dylan Johnston',
            'email'    => 'dylan@kerigan.com',
            'password' => bcrypt('Demo123'),
            'facility' => 'Demo'
        ]);
    }
}
