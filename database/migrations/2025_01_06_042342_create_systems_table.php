<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('systems', function (Blueprint $table) {
            $table->id();
            $table->string('systems')->unique(); // Nama sistem, mesti unik
            $table->enum('status', ['active', 'inactive'])->default('active'); // Status aktif/inaktif
            $table->unsignedBigInteger('created_by')->nullable(); // Pengguna yang mencipta
            $table->unsignedBigInteger('edited_by')->nullable(); // Pengguna yang mengemaskini
            $table->timestamps(); // Kolum created_at dan updated_at
            $table->softDeletes(); // Kolum deleted_at untuk soft deletes

            // Foreign key untuk pengguna, jika menggunakan jadual 'users'
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('edited_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('systems');
    }
}
