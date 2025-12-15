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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('customer');
            $table->string('email')->nullable();
            $table->text('alamat')->nullable();
            $table->string('telepon')->nullable();
            $table->date('order_date');
            $table->decimal('total', 12, 2);
            $table->json('items')->nullable();
            $table->enum('payment_method', ['cod', 'transfer_bank', 'e_wallet', 'xendit']);
            $table->enum('status', ['baru', 'diproses', 'dikirim', 'selesai', 'dibatalkan'])->default('baru');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
