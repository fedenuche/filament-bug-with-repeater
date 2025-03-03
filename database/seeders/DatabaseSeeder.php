<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\User;
use App\Models\Vocabulary;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
        ]);

        Lesson::create([
            'title' => 'This is the first lesson',
            'slug' => 'this-is-the-first-lesson',
            'short_description' => 'This is the short description for the first lesson',
            'content' => 'This is the long description for the first lesson',
            'sort' => 1
        ]);

        Lesson::create([
            'title' => 'This is the second lesson',
            'slug' => 'this-is-the-second-lesson',
            'short_description' => 'This is the short description for the second lesson',
            'content' => 'This is the long description for the second lesson',
            'sort' => 2
        ]);


        Vocabulary::create([
            'term' => 'This is the first term',
            'definition' => 'This is the first term definition',
        ]);

        Vocabulary::create([
            'term' => 'This is the second term',
            'definition' => 'This is the second term definition',
        ]);

        Vocabulary::create([
            'term' => 'This is the third term',
            'definition' => 'This is the third term definition',
        ]);

        Vocabulary::create([
            'term' => 'This is the fourth term',
            'definition' => 'This is the fourth term definition',
        ]);
    }
}
