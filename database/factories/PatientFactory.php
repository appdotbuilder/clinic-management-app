<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jenisKelamin = fake()->randomElement(['Laki-laki', 'Perempuan']);
        
        return [
            'nama' => fake('id_ID')->name(),
            'tanggal_lahir' => fake()->dateTimeBetween('-80 years', '-1 year')->format('Y-m-d'),
            'jenis_kelamin' => $jenisKelamin,
            'kontak' => fake()->optional(0.8)->numerify('08##########'),
            'alamat' => fake('id_ID')->optional(0.7)->address(),
            'alergi' => fake()->optional(0.3)->randomElement([
                'Alergi obat penisilin',
                'Alergi makanan laut',
                'Alergi debu',
                'Alergi kacang',
                'Alergi susu',
                'Alergi telur',
                'Asma',
            ]),
            'catatan' => fake()->optional(0.4)->sentence(),
        ];
    }
}