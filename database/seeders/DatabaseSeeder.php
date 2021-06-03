<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){
        $this->call(InitializeUserRolesPermissionsArjiSeeder::class);
        $this->call(InitializeCatalogosArjiSeeder::class);
        $this->call(ImportUsers01Seeder::class);
        $this->call(ImportUsers02Seeder::class);
    }
}
