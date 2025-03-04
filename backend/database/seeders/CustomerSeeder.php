<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'name' => 'John Smith',
                'company_name' => 'ABC Corporation',
                'email' => 'john@abccorp.com',
                'phone' => '555-123-4567',
                'address' => '123 Main St',
                'city' => 'New York',
                'state' => 'NY',
                'postal_code' => '10001',
                'country' => 'USA',
                'contact_person' => 'Jane Doe',
                'notes' => 'Premium customer since 2020',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sarah Johnson',
                'company_name' => 'XYZ Industries',
                'email' => 'sarah@xyzindustries.com',
                'phone' => '555-987-6543',
                'address' => '456 Oak Ave',
                'city' => 'Los Angeles',
                'state' => 'CA',
                'postal_code' => '90001',
                'country' => 'USA',
                'contact_person' => 'Mike Wilson',
                'notes' => 'Requires special handling for deliveries',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Robert Chen',
                'company_name' => 'Global Enterprises',
                'email' => 'robert@globalent.com',
                'phone' => '555-456-7890',
                'address' => '789 Pine Blvd',
                'city' => 'Chicago',
                'state' => 'IL',
                'postal_code' => '60601',
                'country' => 'USA',
                'contact_person' => 'Lisa Wang',
                'notes' => 'International shipping required',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('customers')->insert($customers);
    }
}
