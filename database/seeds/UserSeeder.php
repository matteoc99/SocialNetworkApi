<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 5)->create();
        DB::table('users')->insert([
            'name' => "Matteo",
            'email' => "matteo.cosi@live.it",
            'password' => bcrypt("1234"),
        ]);
    }
}
