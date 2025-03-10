<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CustomerSeeder::class,
            ProductSeeder::class,
            CategorySeeder::class,
            ManualSeeder::class,
            DeviceSeeder::class,
            TicketSeeder::class,
            EngineeringNoteSeeder::class,
        ]);
    }
}
