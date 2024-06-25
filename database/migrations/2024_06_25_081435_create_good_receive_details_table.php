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
        Schema::create('good_receive_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_gr');
            $table->foreignId('id_po');
            $table->string('material');
            $table->string('qty');
            $table->string('qty_receive_previous')->default(0);
            $table->string('isdelete')->default(0);
            $table->foreignId('id_satuan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('good_receive_details');
    }
};
