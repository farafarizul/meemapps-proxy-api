<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('endpoint_configs', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('upstream_url');
            $table->string('http_method')->default('GET');
            $table->json('headers_json')->nullable();
            $table->json('options_json')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('endpoint_configs');
    }
};
