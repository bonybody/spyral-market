<?php

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //php
        for ($i = 2; $i < 20; $i++) {
            $param = [
                'name' => $i . '書籍',
                'price' => $i * 100,
                'text' => 'これは' . $i . '個目の書籍です。',
                'seller_id' => 2,
                'status' => 'sale',
                'created_at' => now(),
                'updated_at' => now(),
            ];
            DB::table('items')->insert($param);
        }
    }
}
