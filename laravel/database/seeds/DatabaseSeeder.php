<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
//        $this->call(AdminsSeeder::class);
//        $this->call(ItemsTableSeeder::class);
//        $this->call(Item_imagesTableSeeder::class);
//        $this->call(SubjectsTableSeeder::class);
//        $this->call(TagsTableSeeder::class);
//        $this->call(Sbj_tag_linksTableSeeder::class);
        $this->call(Registered_tagsTableSeeder::class);
    }
}
