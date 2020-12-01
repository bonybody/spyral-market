<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => '高度情報学科',
            'school_id' => '1'
        ];
        DB::table('courses')->insert($param);

        $param = [
            'name' => 'ファッションデザイン学科',
            'school_id' => '2'
        ];
        DB::table('courses')->insert($param);

        $param = [
            'name' => '高度専門士看護学科',
            'school_id' => '3'
        ];
        DB::table('courses')->insert($param);

    }
}
