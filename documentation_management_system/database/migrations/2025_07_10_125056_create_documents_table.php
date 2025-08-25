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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();

            // Relations
            $table->foreignId('editor_id')
                ->constrained('editors')
                ->cascadeOnDelete();

            $table->foreignId('category_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // Core fields
            $table->string('title');
            $table->string('type');
            $table->text('content');

            // Status
            $table->enum('status', ['draft', 'published'])->default('draft');

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
