<?php

namespace SoftC\Installer\Database\Seeders;

use Illuminate\Database\Seeder;
use SoftC\Installer\Database\Seeders\Person\DatabaseSeeder as PersonSeeder;

class DatabaseSeeder extends Seeder
{
    public function run($parameters = []): void {
        $this->call(PersonSeeder::class, false, $parameters);
    }
}