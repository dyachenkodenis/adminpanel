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
        Schema::create('web_components', function (Blueprint $table) {
            $table->id();
            $table->string('title');

            $table->unsignedBigInteger('page_id')->nullable();

            $table->unsignedBigInteger('custom_fields_id')->nullable();

            $table->unsignedBigInteger('widget_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web_components');
    }
};
