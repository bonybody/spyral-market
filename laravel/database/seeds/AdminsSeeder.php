<?php

use Illuminate\Database\Seeder;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'test_name',
            'email' => 'test_mail',
            'password' => Hash::make('pass'),
        ]);
    }
}
