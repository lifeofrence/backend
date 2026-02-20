<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('corporate_actions', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('category');
            $table->string('title');
            $table->text('summary')->nullable();
            $table->longText('content')->nullable();
            $table->string('link_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('corporate_actions');
    }
};
