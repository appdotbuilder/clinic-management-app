<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->comment('Patient name');
            $table->date('tanggal_lahir')->comment('Date of birth');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->comment('Gender');
            $table->string('kontak')->nullable()->comment('Contact information');
            $table->text('alamat')->nullable()->comment('Address');
            $table->text('alergi')->nullable()->comment('Known allergies');
            $table->text('catatan')->nullable()->comment('Additional notes');
            $table->timestamps();
            
            // Indexes for performance
            $table->index('nama');
            $table->index('tanggal_lahir');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};