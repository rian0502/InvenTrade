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
        //
        Schema::create('unit_conversions', function (Blueprint $table) {
            $table->id();
            $table->string('conversion_name');
            $table->decimal('conversion_value', 10, 2);
            $table->boolean('is_active')->default(true);
            $table->foreignId('from_unit_id')->references('id')->on('unit_of_measures')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('to_unit_id')->references('id')->on('unit_of_measures')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_conversions');
    }
};
