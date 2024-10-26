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
        Schema::create('purchase_order_headers', function (Blueprint $table) {
            $table->id();
            $table->string('po_number', 20)->unique();
            $table->date('po_date');
            $table->date('delivery_date');
            $table->enum('payment_term', ['CAD', 'CBD', 'COD', 'DP']);
            $table->enum('status', ['draft', 'approved', 'rejected', 'completed', 'canceled'])->default('draft');
            $table->decimal('total', 15, 2);
            $table->text('description')->nullable();
            $table->foreignId('partner_id')->constrained('partners');
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
        Schema::dropIfExists('purchase_order_headers');
    }
};
