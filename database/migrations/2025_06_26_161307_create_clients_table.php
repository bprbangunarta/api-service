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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('client_id')->unique();
            $table->string('client_name');
            $table->string('client_key')->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('clients_logs', function (Blueprint $table) {
            $table->id();
            $table->string('client_id')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('method');
            $table->text('url');
            $table->string('response_status')->nullable();
            $table->longText('response_body')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
        Schema::dropIfExists('clients_logs');
    }
};
