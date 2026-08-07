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
        Schema::create('expert_expertises', function (Blueprint $table) {
            $table->foreignId('expert_id')->constrained('experts')->cascadeOnDelete();
            $table->foreignId('expertise_category_id')->constrained('expertise_categories')->cascadeOnDelete();

            $table->primary(['expert_id','expertise_category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expert_expertises');
    }
};
