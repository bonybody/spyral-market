<?php

use Illuminate\Database\Seeder;

class Registered_tagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 1; $i < 5; $i++) {
            $param = [
                'item_id' => $i,
                'tag_id' => $i,
            ];
            DB::table('registered_tags')->insert($param);
        }
    }
}
