<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'その他',
        ];
        DB::table('categories')->insert($param);
        $param = [
            'name' => 'HAL系',
        ];
        DB::table('categories')->insert($param);
        $param = [
            'name' => 'MODE学園系',
        ];
        DB::table('categories')->insert($param);
        $param = [
            'name' => '医専系',
        ];
        DB::table('categories')->insert($param);
    }

}
