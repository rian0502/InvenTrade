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
        Schema::create('transaction_headers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->index();
            $table->date('transaction_date');
            $table->string('description');
            $table->enum('transaction_type', ['IN', 'OUT', 'RETURN']);
            $table->foreignId('partner_id')->constrained('partners')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('transaction_headers');
    }
};
