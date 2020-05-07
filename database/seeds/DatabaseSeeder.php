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
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(FriendshipSeeder::class);
        $this->call(ChatSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(MessageSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(NotificationSeeder::class);
    }
}
