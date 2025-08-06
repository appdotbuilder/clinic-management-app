<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Patient;
use App\Models\PatientVisit;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@clinic.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create doctor user
        User::factory()->create([
            'name' => 'Dr. Ahmad Santoso',
            'email' => 'doctor@clinic.com',
            'password' => Hash::make('password'),
            'role' => 'doctor',
        ]);

        // Create receptionist user
        User::factory()->create([
            'name' => 'Siti Nurhaliza',
            'email' => 'receptionist@clinic.com',
            'password' => Hash::make('password'),
            'role' => 'receptionist',
        ]);

        // Create sample patients
        $patients = Patient::factory(20)->create();

        // Create sample visits for each patient
        $patients->each(function ($patient) {
            PatientVisit::factory(random_int(1, 5))->create([
                'patient_id' => $patient->id,
            ]);
        });
    }
}