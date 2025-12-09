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
        Schema::create('document_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('document_type');
            $table->string('purpose');
            $table->json('required_info')->nullable();
            $table->enum('status', ['pending', 'processing', 'ready', 'claimed', 'rejected'])->default('pending');
            $table->decimal('fee', 8, 2)->default(0);
            $table->boolean('payment_status')->default(false);
            $table->string('tracking_number')->unique();
            $table->text('remarks')->nullable();
            $table->timestamp('claimed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_requests');
    }
};
