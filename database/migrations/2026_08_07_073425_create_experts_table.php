<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('experts', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('highest_education')->nullable();
            $table->string('current_position')->nullable();
            $table->text('expertise_details')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email')->nullable()->index();
            $table->string('line_id', 100)->nullable();
            $table->string('workplace')->nullable()->index();
            $table->string('profile_image')->nullable();
            $table->boolean('is_published')->default(true)->index();
            $table->boolean('show_contact')->default(false);
            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('experts');
    }
};