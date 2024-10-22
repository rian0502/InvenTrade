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
        Schema::create('purchase_order_taxes', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 15, 2);
            $table->foreignId('tax_id')->constrained('taxes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('order_id')->constrained('purchase_order_headers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('purchase_order_taxes');
    }
};
