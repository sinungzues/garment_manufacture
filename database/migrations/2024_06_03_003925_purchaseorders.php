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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_dept')->nullable();
            $table->foreignId('id_user_in')->nullable();
            $table->string('nopo');
            $table->dateTime('date')->nullable();
            $table->foreignId('id_suplier');
            $table->string('remarks');
            $table->string('attention');
            $table->string('ppn');
            $table->integer('id_currency');
            $table->string('status')->default('P');
            $table->string('total_ppn')->nullable();
            $table->boolean('isdelete')->default(0);
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
        Schema::dropIfExists('purchase_orders');
    }
};
