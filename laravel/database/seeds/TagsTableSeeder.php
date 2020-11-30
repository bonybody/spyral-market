<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
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
            'name' => 'PHP',
        ];
        DB::table('tags')->insert($param);

        $param = [
            'name' => 'C++',
        ];
        DB::table('tags')->insert($param);

        $param = [
            'name' => '基本情報技術者資格',
        ];
        DB::table('tags')->insert($param);

        $param = [
            'name' => 'JavaScript',
        ];
        DB::table('tags')->insert($param);

        $param = [
            'name' => 'HTML',
        ];
        DB::table('tags')->insert($param);

        $param = [
            'name' => 'CSS',
        ];
        DB::table('tags')->insert($param);

        $param = [
            'name' => 'WEBデザイン',
        ];
        DB::table('tags')->insert($param);

        $param = [
            'name' => 'MySQL',
        ];
        DB::table('tags')->insert($param);

    }
}
