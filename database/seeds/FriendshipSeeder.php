<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FriendshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('friendship')->insert([
            'user_1_id' => 6,
            'user_2_id' => 2,
            'status' => 1,
        ]);

        DB::table('friendship')->insert([
            'user_1_id' => 6,
            'user_2_id' => 1,
            'status' => 0,
        ]);
        DB::table('friendship')->insert([
            'user_1_id' => 4,
            'user_2_id' => 6,
            'status' => 0,
        ]);
        DB::table('friendship')->insert([
            'user_1_id' => 3,
            'user_2_id' => 6,
            'status' => 1,
        ]);

    }
}
