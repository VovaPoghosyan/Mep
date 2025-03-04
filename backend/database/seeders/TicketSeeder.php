<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tickets = [
            [
                'device_id' => 1, // Coffee Machine #1
                'customer_id' => 1, // ABC Corporation
                'title' => 'Coffee machine not heating water properly',
                'description' => 'The water temperature is inconsistent and sometimes not hot enough for proper extraction.',
                'reporter_name' => 'Jane Doe',
                'reporter_email' => 'jane@abccorp.com',
                'reporter_phone' => '555-123-4567',
                'status' => 'in_progress',
                'priority' => 'high',
                'availability_time' => 'Weekdays 9am-5pm',
                'resolved_at' => null,
                'resolution_notes' => null,
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(3),
            ],
            [
                'device_id' => 2, // Convection Oven #1
                'customer_id' => 2, // XYZ Industries
                'title' => 'Oven temperature calibration issue',
                'description' => 'The oven temperature seems to be about 15 degrees higher than the set temperature.',
                'reporter_name' => 'Mike Wilson',
                'reporter_email' => 'mike@xyzindustries.com',
                'reporter_phone' => '555-987-6543',
                'status' => 'new',
                'priority' => 'medium',
                'availability_time' => 'Weekdays after 3pm',
                'resolved_at' => null,
                'resolution_notes' => null,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'device_id' => 3, // Stand Mixer #1
                'customer_id' => 3, // Global Enterprises
                'title' => 'Unusual noise during operation',
                'description' => 'The mixer is making a grinding noise when operating at high speeds.',
                'reporter_name' => 'Lisa Wang',
                'reporter_email' => 'lisa@globalent.com',
                'reporter_phone' => '555-456-7890',
                'status' => 'resolved',
                'priority' => 'low',
                'availability_time' => 'Anytime during business hours',
                'resolved_at' => now()->subDay(),
                'resolution_notes' => 'Tightened the loose belt and applied lubricant to the gears.',
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDay(),
            ],
        ];

        DB::table('tickets')->insert($tickets);

        // Create ticket comments
        $ticketComments = [
            [
                'ticket_id' => 1,
                'user_id' => 2, // Tech Support
                'content' => 'I\'ll check the heating element and temperature sensor during the visit.',
                'is_private' => false,
                'is_system' => false,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'ticket_id' => 1,
                'user_id' => 1, // Admin User
                'content' => 'Please also check the water pump pressure.',
                'is_private' => true,
                'is_system' => false,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'ticket_id' => 3,
                'user_id' => 2, // Tech Support
                'content' => 'Found a loose belt and some dry gears. Fixed both issues and tested the mixer at all speeds.',
                'is_private' => false,
                'is_system' => false,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
        ];

        DB::table('ticket_comments')->insert($ticketComments);

        // Create ticket attachments
        $ticketAttachments = [
            [
                'ticket_id' => 1,
                'file_name' => 'temperature_log.pdf',
                'file_path' => 'attachments/tickets/1/temperature_log.pdf',
                'file_size' => 1024 * 500, // 500 KB
                'file_type' => 'application/pdf',
                'uploaded_by' => 1, // Admin User
                'created_at' => now()->subDays(4),
                'updated_at' => now()->subDays(4),
            ],
            [
                'ticket_id' => 3,
                'file_name' => 'mixer_noise.mp3',
                'file_path' => 'attachments/tickets/3/mixer_noise.mp3',
                'file_size' => 1024 * 1024 * 2, // 2 MB
                'file_type' => 'audio/mpeg',
                'uploaded_by' => 3, // Regular User
                'created_at' => now()->subDays(6),
                'updated_at' => now()->subDays(6),
            ],
        ];

        DB::table('ticket_attachments')->insert($ticketAttachments);
    }
}
