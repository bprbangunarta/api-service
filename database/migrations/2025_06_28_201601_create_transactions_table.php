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
            $table->string('number')->unique();
            $table->string('office')->default('01');
            $table->string('collector_code');
            $table->enum('type', ['deposit', 'withdrawal'])->default('deposit');
            $table->string('account');
            $table->string('source')->nullable();
            $table->string('destination')->nullable();
            $table->integer('amount');
            $table->integer('previous_balance');
            $table->integer('ending_balance');
            $table->string('description');
            $table->timestamps();
            $table->timestamp('synced_at')->nullable();
            $table->softDeletes();
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
