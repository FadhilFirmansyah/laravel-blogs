<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        User::create([
            "name" => "Fadhil Firmansyah",
            "username" => "dhildhil",
            "email" => "fadhil@gmail.com",
            "password" => bcrypt("password")
        ]);

        User::factory(5)->create();
        Category::create([
            "name" => "Front-End",
            "slug" => "front-end"
        ]);
        Category::create([
            "name" => "Back-End",
            "slug" => "back-end"
        ]);
        Category::create([
            "name" => "DevOps",
            "slug" => "devops"
        ]);
        Blog::factory(20)->create();
    }
}
