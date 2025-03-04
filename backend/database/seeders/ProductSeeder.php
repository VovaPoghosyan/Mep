<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'sku' => 'COFFEE-001',
                'name' => 'Professional Coffee Machine',
                'description' => 'High-end professional coffee machine for commercial use',
                'manufacturer_id' => 1,
                'model_number' => 'CM-5000',
                'specifications' => json_encode([
                    'power' => '2400W',
                    'capacity' => '5L',
                    'pressure' => '15 bar',
                    'dimensions' => '45x30x40 cm',
                    'weight' => '15 kg',
                ]),
                'image_url' => 'images/products/coffee-machine.jpg',
                'documentation_url' => 'docs/coffee-machine-manual.pdf',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sku' => 'OVEN-002',
                'name' => 'Commercial Convection Oven',
                'description' => 'Industrial grade convection oven for bakeries and restaurants',
                'manufacturer_id' => 2,
                'model_number' => 'OV-3000',
                'specifications' => json_encode([
                    'power' => '6000W',
                    'capacity' => '120L',
                    'temperature_range' => '50-300°C',
                    'dimensions' => '90x85x120 cm',
                    'weight' => '95 kg',
                ]),
                'image_url' => 'images/products/convection-oven.jpg',
                'documentation_url' => 'docs/oven-manual.pdf',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sku' => 'MIXER-003',
                'name' => 'Industrial Stand Mixer',
                'description' => 'Heavy-duty stand mixer for commercial kitchens',
                'manufacturer_id' => 3,
                'model_number' => 'MX-7500',
                'specifications' => json_encode([
                    'power' => '1200W',
                    'capacity' => '10L',
                    'speeds' => '10',
                    'dimensions' => '40x35x55 cm',
                    'weight' => '25 kg',
                ]),
                'image_url' => 'images/products/stand-mixer.jpg',
                'documentation_url' => 'docs/mixer-manual.pdf',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('products')->insert($products);
    }
}
