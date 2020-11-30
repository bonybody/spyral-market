<?php

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $param = [
            'course_id' => 12,
            'name' => 'PH11',
        ];
        DB::table('subjects')->insert($param);

        $param = [
            'course_id' => 12,
            'name' => 'PH12',
        ];
        DB::table('subjects')->insert($param);

        $param = [
            'course_id' => 12,
            'name' => 'WB11',
        ];
        DB::table('subjects')->insert($param);

        $param = [
            'course_id' => 12,
            'name' => 'WB12',
        ];
        DB::table('subjects')->insert($param);

        $param = [
            'course_id' => 12,
            'name' => 'CS11',
        ];
        DB::table('subjects')->insert($param);

        $param = [
            'course_id' => 12,
            'name' => 'SL11',
        ];
        DB::table('subjects')->insert($param);

        $param = [
            'course_id' => 12,
            'name' => 'IH11',
        ];
        DB::table('subjects')->insert($param);

        $param = [
            'course_id' => 12,
            'name' => 'IS11',
        ];
        DB::table('subjects')->insert($param);

        $param = [
            'course_id' => 12,
            'name' => 'CT11',
        ];
        DB::table('subjects')->insert($param);

        $param = [
            'course_id' => 12,
            'name' => 'DB11',
        ];
        DB::table('subjects')->insert($param);

        $param = [
            'course_id' => 12,
            'name' => 'IT11',
        ];
        DB::table('subjects')->insert($param);

        $param = [
            'course_id' => 12,
            'name' => 'OT1C',
        ];
        DB::table('subjects')->insert($param);

    }
}
