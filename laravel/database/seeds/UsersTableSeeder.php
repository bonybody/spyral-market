<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'guest01',
            'email' => 'guest01@example.email.com',
            'password' => Hash::make('password'),
            'school_id' => '1',
            'course_id' => '1',
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => 'guest02',
            'email' => 'guest02@example.email.com',
            'password' => Hash::make('password'),
            'school_id' => '2',
            'course_id' => '2',
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => 'guest03',
            'email' => 'guest03@example.email.com',
            'password' => Hash::make('password'),
            'school_id' => '3',
            'course_id' => '3',
        ];
        DB::table('users')->insert($param);
    }
}
