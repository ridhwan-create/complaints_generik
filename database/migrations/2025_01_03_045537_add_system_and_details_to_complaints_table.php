<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->string('system')->after('complainer_ic'); // Ruangan 'system'
            $table->text('details')->after('system'); // Ruangan 'details'
        });
    }

    public function down(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->dropColumn('system');
            $table->dropColumn('details');
        });
    }
};
