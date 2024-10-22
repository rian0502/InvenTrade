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
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->decimal('price', 18, 2);
            $table->decimal('discount', 18, 2)->default(0);
            $table->decimal('total', 18, 2);
            $table->foreignId('transaction_id')->constrained('transaction_headers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('unit_of_measure_id')->constrained('unit_of_measures')->onDelete('cascade')->onUpdate('cascade');
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
        //
        Schema::dropIfExists('transaction_details');
    }
};
