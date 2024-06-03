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
        Schema::create('supliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('address');
            $table->string('tel')->nullable();
            $table->string('fax')->nullable();
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
        Schema::dropIfExists('supliers');
    }
};
