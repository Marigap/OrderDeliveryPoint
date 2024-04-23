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
        Schema::create('delivery_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_info_id');
            $table->foreign('order_info_id')->references('id')->on('order_infos')->onDelete('cascade');
            $table->enum('status', ['accepted', 'processing', 'in_transit', 'delivered', 'picked_up']);
            $table->string('current_location');
            $table->boolean('need_notify');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_infos');
    }
};