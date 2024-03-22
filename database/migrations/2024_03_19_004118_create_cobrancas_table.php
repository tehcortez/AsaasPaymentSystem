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
        Schema::create('cobrancas', function (Blueprint $table) {
            $table->id();
            $table->string('id_asaas')->unique();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('billing_type');
            $table->integer('value');
            $table->timestamp('due_date');
            $table->text('boleto_bank_slip_url')->nullable();
            $table->text('pix_encoded_image')->nullable();
            $table->text('pix_payload')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cobrancas');
    }
};
