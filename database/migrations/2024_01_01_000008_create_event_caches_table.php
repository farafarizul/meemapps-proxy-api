<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_caches', function (Blueprint $table) {
            $table->id();
            $table->date('event_date')->unique();
            $table->text('explanation')->nullable();
            $table->string('source')->default('gemini');
            $table->boolean('is_valid')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_caches');
    }
};
