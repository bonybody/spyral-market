<?php

use Illuminate\Database\Seeder;

class SchoolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'HAL'
        ];
        DB::table('schools')->insert($param);

        $param = [
            'name' => 'MODE学園'
        ];
        DB::table('schools')->insert($param);

        $param = [
            'name' => '医専'
        ];
        DB::table('schools')->insert($param);

    }
}
