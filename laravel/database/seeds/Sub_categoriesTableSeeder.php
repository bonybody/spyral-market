<?php

use Illuminate\Database\Seeder;

class Sub_categoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'category_id' => '1',
            'name' => 'その他'
        ];
        DB::table('sub_categories')->insert($param);

        $param = [
            'category_id' => '2',
            'name' => 'WEB'
        ];
        DB::table('sub_categories')->insert($param);

        $param = [
            'category_id' => '3',
            'name' => 'ファッション'
        ];
        DB::table('sub_categories')->insert($param);

        $param = [
            'category_id' => '4',
            'name' => '解剖学'
        ];
        DB::table('sub_categories')->insert($param);

    }
}
