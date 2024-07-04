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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('ticket_id');
            $table->foreign('ticket_id')->references('id')->on('tickets');

            $table->date('validitydate');
            $table->integer('qty');
            $table->integer('total_price');
            $table->string('contact_name');
            $table->string('contact_number');
            $table->string('contact_email');
            $table->string('visitor_name')->nullable();
            $table->string('visitor_number')->nullable();
            $table->string('visitor_email')->nullable();
            $table->string('identity_number');
            $table->string('status');
            $table->string('code')->unique()->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_due_time')->nullable();
            $table->string('payment_success')->nullable();


            $table->string('order_id')->unique()->nullable();
            $table->string('snap_token')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
