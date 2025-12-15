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
        Schema::table('orders', function (Blueprint $table) {
            // Change enum to string to support more values
            $table->string('payment_method')->change();
            $table->string('status')->default('baru')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Revert back to enum if needed (might be tricky if data exists not in enum)
            // For safety we can leave as string or try to revert
            // $table->enum('payment_method', ['cod', 'transfer_bank', 'e_wallet', 'xendit'])->change();
            // $table->enum('status', ['baru', 'diproses', 'dikirim', 'selesai', 'dibatalkan'])->default('baru')->change();
        });
    }
};
