<?php

namespace SoftC\Installer\Database\Seeders\Person;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PersonSeeder extends Seeder
{
    public function run($parameters = []): void
    {
        DB::table('persons')->delete();

        DB::table('persons')->insert([
            'name' => fake()->name(),
            'email' => fake()->email(),
            'phone' => fake()->phoneNumber(),
        ]);
    }
}