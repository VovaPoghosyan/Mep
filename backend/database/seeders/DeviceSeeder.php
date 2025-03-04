<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $devices = [
            [
                'qr_code' => 'DEV-' . Str::random(8),
                'name' => 'Coffee Machine #1',
                'serial_number' => 'CM5000-' . Str::random(6),
                'product_id' => 1, // Professional Coffee Machine
                'customer_id' => 1, // ABC Corporation
                'order_number' => 'ORD-' . rand(10000, 99999),
                'warranty_months' => 24,
                'warranty_notes' => 'Extended warranty package',
                'delivery_date' => now()->subMonths(6),
                'installation_date' => now()->subMonths(5)->subDays(15),
                'status' => 'active',
                'notes' => 'Installed in main kitchen area',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'qr_code' => 'DEV-' . Str::random(8),
                'name' => 'Convection Oven #1',
                'serial_number' => 'OV3000-' . Str::random(6),
                'product_id' => 2, // Commercial Convection Oven
                'customer_id' => 2, // XYZ Industries
                'order_number' => 'ORD-' . rand(10000, 99999),
                'warranty_months' => 36,
                'warranty_notes' => 'Premium service package included',
                'delivery_date' => now()->subMonths(3),
                'installation_date' => now()->subMonths(2)->subDays(25),
                'status' => 'active',
                'notes' => 'Installed in bakery section',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'qr_code' => 'DEV-' . Str::random(8),
                'name' => 'Stand Mixer #1',
                'serial_number' => 'MX7500-' . Str::random(6),
                'product_id' => 3, // Industrial Stand Mixer
                'customer_id' => 3, // Global Enterprises
                'order_number' => 'ORD-' . rand(10000, 99999),
                'warranty_months' => 12,
                'warranty_notes' => 'Standard warranty',
                'delivery_date' => now()->subMonths(1),
                'installation_date' => now()->subMonths(1)->subDays(5),
                'status' => 'active',
                'notes' => 'Installed in pastry preparation area',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('devices')->insert($devices);

        // Create device-manual relationships
        $deviceManuals = [
            [
                'device_id' => 1,
                'manual_id' => 1, // Coffee Machine User Manual
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'device_id' => 1,
                'manual_id' => 2, // Coffee Machine Service Manual
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'device_id' => 2,
                'manual_id' => 3, // Oven User Manual
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'device_id' => 3,
                'manual_id' => 4, // Mixer User Manual
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('device_manual')->insert($deviceManuals);

        // Create device-category relationships
        $deviceCategories = [
            [
                'device_id' => 1,
                'category_id' => 2, // Espresso Machines
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'device_id' => 2,
                'category_id' => 4, // Ovens
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'device_id' => 3,
                'category_id' => 6, // Mixers
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('category_device')->insert($deviceCategories);
    }
}
