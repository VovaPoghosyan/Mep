<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Coffee Equipment',
                'slug' => 'coffee-equipment',
                'description' => 'Professional coffee machines and accessories',
                'parent_id' => null,
                'is_active' => true,
                'display_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Espresso Machines',
                'slug' => 'espresso-machines',
                'description' => 'Commercial espresso machines for cafes and restaurants',
                'parent_id' => 1, // Will be the ID of Coffee Equipment
                'is_active' => true,
                'display_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cooking Equipment',
                'slug' => 'cooking-equipment',
                'description' => 'Professional cooking equipment for commercial kitchens',
                'parent_id' => null,
                'is_active' => true,
                'display_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ovens',
                'slug' => 'ovens',
                'description' => 'Commercial ovens for bakeries and restaurants',
                'parent_id' => 3, // Will be the ID of Cooking Equipment
                'is_active' => true,
                'display_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Food Preparation',
                'slug' => 'food-preparation',
                'description' => 'Equipment for food preparation in commercial kitchens',
                'parent_id' => null,
                'is_active' => true,
                'display_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mixers',
                'slug' => 'mixers',
                'description' => 'Commercial mixers for bakeries and restaurants',
                'parent_id' => 5, // Will be the ID of Food Preparation
                'is_active' => true,
                'display_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}
