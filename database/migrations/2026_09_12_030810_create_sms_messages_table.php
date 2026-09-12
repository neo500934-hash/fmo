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
        Schema::create('sms_messages', function (Blueprint $table) {
            $table->id();
            $table->string('direction'); // 'inbound' or 'outbound'
            $table->string('from_number');
            $table->string('to_number');
            $table->text('body');
            $table->string('provider_sid')->nullable(); // Twilio's message SID
            $table->string('status')->default('received'); // received, pending, sent, failed
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sms_messages');
    }
};
