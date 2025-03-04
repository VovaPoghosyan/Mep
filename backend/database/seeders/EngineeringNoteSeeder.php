<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EngineeringNoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $engineeringNotes = [
            [
                'device_id' => 1, // Coffee Machine #1
                'company' => 'MEP Service Team',
                'technician_id' => 2, // Tech Support
                'notes' => 'Initial installation completed. Pressure set to 9 bar, temperature calibrated to 93°C. All systems functioning properly.',
                'report_error' => null,
                'file_path' => 'engineering/notes/coffee-machine-installation.pdf',
                'created_at' => now()->subMonths(5)->subDays(15),
                'updated_at' => now()->subMonths(5)->subDays(15),
            ],
            [
                'device_id' => 1, // Coffee Machine #1
                'company' => 'MEP Service Team',
                'technician_id' => 2, // Tech Support
                'notes' => 'Routine maintenance performed. Descaled boiler, replaced group head gaskets, cleaned portafilters and shower screens. Machine functioning optimally.',
                'report_error' => null,
                'file_path' => 'engineering/notes/coffee-machine-maintenance.pdf',
                'created_at' => now()->subMonths(2),
                'updated_at' => now()->subMonths(2),
            ],
            [
                'device_id' => 2, // Convection Oven #1
                'company' => 'MEP Service Team',
                'technician_id' => 2, // Tech Support
                'notes' => 'Installation completed. Oven calibrated and tested at various temperature settings. All heating elements and fans functioning properly.',
                'report_error' => null,
                'file_path' => 'engineering/notes/oven-installation.pdf',
                'created_at' => now()->subMonths(2)->subDays(25),
                'updated_at' => now()->subMonths(2)->subDays(25),
            ],
            [
                'device_id' => 3, // Stand Mixer #1
                'company' => 'MEP Service Team',
                'technician_id' => 2, // Tech Support
                'notes' => 'Installation completed. All attachments tested and functioning properly. Demonstrated proper usage to kitchen staff.',
                'report_error' => null,
                'file_path' => 'engineering/notes/mixer-installation.pdf',
                'created_at' => now()->subMonths(1)->subDays(5),
                'updated_at' => now()->subMonths(1)->subDays(5),
            ],
        ];

        DB::table('engineering_notes')->insert($engineeringNotes);
    }
}
