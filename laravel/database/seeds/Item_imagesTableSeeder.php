<?php

use Illuminate\Database\Seeder;

class Item_imagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 2; $i < 20; $i++) {
            $param = [
                'item_id' => $i,
                'image' => $i . '.jpg',
            ];
            DB::table('item_images')->insert($param);
        }
    }
}
