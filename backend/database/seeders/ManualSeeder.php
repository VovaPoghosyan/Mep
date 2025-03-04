<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManualSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $manuals = [
            [
                'title' => 'Professional Coffee Machine User Manual',
                'description' => 'Complete user guide for the Professional Coffee Machine',
                'file_path' => 'manuals/coffee-machine-user.pdf',
                'version' => '1.2',
                'language' => 'en',
                'type' => 'user',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Professional Coffee Machine Service Manual',
                'description' => 'Technical service guide for the Professional Coffee Machine',
                'file_path' => 'manuals/coffee-machine-service.pdf',
                'version' => '1.1',
                'language' => 'en',
                'type' => 'service',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Commercial Convection Oven User Manual',
                'description' => 'Complete user guide for the Commercial Convection Oven',
                'file_path' => 'manuals/oven-user.pdf',
                'version' => '2.0',
                'language' => 'en',
                'type' => 'user',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Industrial Stand Mixer User Manual',
                'description' => 'Complete user guide for the Industrial Stand Mixer',
                'file_path' => 'manuals/mixer-user.pdf',
                'version' => '1.5',
                'language' => 'en',
                'type' => 'user',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('manuals')->insert($manuals);
    }
}
