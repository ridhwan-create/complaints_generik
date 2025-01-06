<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            // Padamkan kolum complainer_ic
            $table->dropColumn('complainer_ic');

            // Tambahkan kolum baharu
            $table->string('contact_number')->after('complainer'); // Nombor telefon
            $table->string('email')->after('contact_number'); // E-mel
            $table->string('status')->default('pending')->after('details'); // Status aduan
        });
    }

    /**
     * Balikkan migrasi.
     */
    public function down(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            // Tambahkan kembali kolum complainer_ic
            $table->string('complainer_ic')->after('complainer');

            // Padamkan kolum baharu
            $table->dropColumn(['contact_number', 'email', 'status']);
        });
    }
};
