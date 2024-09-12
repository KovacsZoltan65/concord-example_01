<?php

namespace SoftC\Installer\Database\Seeders\Person;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run($parameters = [])
    {
        $this->call(PersonSeeder::class, false, ['parameters' => $parameters]);
    }
}