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
        Schema::create('purchase_order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_po');
            $table->string('material');
            $table->string('qty');
            $table->integer('id_satuan')->nullable();
            $table->float('price');
            $table->boolean('isdelete')->default(0);
            $table->string('user_input')->nullable();
            $table->string('user_edit')->nullable();
            $table->string('user_delete')->nullable();
            $table->dateTime('input_date')->nullable();
            $table->dateTime('edit_date')->nullable();
            $table->dateTime('delete_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_order_details');
    }
};
