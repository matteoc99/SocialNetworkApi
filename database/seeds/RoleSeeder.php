<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => "User",
        ]);
        DB::table('roles')->insert([
            'name' => "Editor",
        ]);
        DB::table('roles')->insert([
            'name' => "Admin",
        ]);
    }
}
