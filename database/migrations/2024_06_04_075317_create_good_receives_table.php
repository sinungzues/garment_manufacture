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
        Schema::create('good_receives', function (Blueprint $table) {
            $table->id();
            $table->string('no_gr');
            $table->string('user_receive');
            $table->string('no_po');
            $table->foreignId('id_suplier');
            $table->foreignId('id_user_in');
            $table->dateTime('date')->nullable();
            $table->string('isdelete')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('good_receives');
    }
};
