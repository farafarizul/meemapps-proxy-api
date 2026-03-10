<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('endpoint_json_overrides', function (Blueprint $table) {
            $table->id();
            $table->string('endpoint_key')->unique();
            $table->string('merge_strategy')->default('merge');
            $table->json('override_json')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('endpoint_json_overrides');
    }
};
