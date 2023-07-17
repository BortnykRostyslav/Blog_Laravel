<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;
use App\Models\BlogPost;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call(UsersTableSeeder::class);
       $this->call(BlogCategoriesTableSeeder::class);
       BlogPost::factory()->count(100)->create();
    }
}
