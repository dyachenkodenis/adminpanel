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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->string('status')->default('activate');
            $table->text('slug')->nullable();
            $table->string('template')->nullable();

            $table->unsignedBigInteger('custom_fields_id')->nullable();
            $table->foreign('custom_fields_id')->references('id')->on('custom_fields');

            $table->unsignedBigInteger('web_components_id')->nullable();
            $table->foreign('web_components_id')->references('id')->on('web_components');


            $table->json('jsonvalue')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
