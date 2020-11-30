<?php

use Illuminate\Database\Seeder;

class Sbj_tag_linksTableSeeder extends Seeder
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
            'tag_id' => 1,
            'subject_id' => 2,
        ];
        DB::table('sbj_tag_links')->insert($param);
        $param = [
            'tag_id' => 2,
            'subject_id' => 1,
        ];
        DB::table('sbj_tag_links')->insert($param);
        $param = [
            'tag_id' => 5,
            'subject_id' => 3,
        ];
        DB::table('sbj_tag_links')->insert($param);
        $param = [
            'tag_id' => 8,
            'subject_id' => 3,
        ];
        DB::table('sbj_tag_links')->insert($param);
    }
}
