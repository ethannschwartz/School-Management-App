<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::factory(1)->create([
             'id' => 1,
             'prefix' => 'Mr.',
             'name' => 'Ethan Schwartz',
             'account_type' => 'teacher',
             'email' => 'e.schwartz@me.com',
             'email_verified_at' => null,
             'password' => Hash::make('password'),
             'remember_token' => null,
             'created_at' => now(),
             'updated_at' => now(),
         ]);

         Course::factory(1)->create([
             'id' => 1,
             'title' => 'General Chemistry',
             'section' => 'A1',
             'code' => 'CH101',
             'description' => 'Learn general chemistry!',
             'user_id' => 1,
             'keycode' => Str::random(20),
             'created_at' => now(),
             'updated_at' => now(),
         ]);

         DB::table('course_user')->insert([
             'id' => 1,
             'user_id' => 1,
             'course_id' => 1,
             'created_at' => now(),
             'updated_at' => now(),
         ]);
    }
}
