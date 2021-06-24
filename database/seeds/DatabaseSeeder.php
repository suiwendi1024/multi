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
         $this->call([
             UserSeeder::class,
             CategorySeeder::class,
             // 博客
             PostSeeder::class,
             // 商店
             ProductSeeder::class,
             OrderSeeder::class,
             WareSeeder::class,
             // 通用
             CommentSeeder::class,
             LikeSeeder::class,
             FavoriteSeeder::class,
         ]);
    }
}
