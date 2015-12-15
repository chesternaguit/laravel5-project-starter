<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        // Register a new user
        Sentinel::register([
            'email'         => 'ccnaguit@piasi.com.ph',
            'last_name'     => 'Naguit',
            'first_name'    => 'Chester',
            'password'      => 'P@ssw0rd'
        ]);

        Sentinel::register([
            'email'         => 'jvmiranda@piasi.com.ph',
            'last_name'     => 'Miranda',
            'first_name'    => 'Jefferson',
            'password'      => 'P@ssw0rd'
        ]);
    }
}
