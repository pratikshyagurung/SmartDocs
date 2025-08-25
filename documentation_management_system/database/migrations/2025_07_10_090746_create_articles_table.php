<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            // Core content
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content');
            $table->text('excerpt')->nullable();

            // Images
            $table->string('image_path')->nullable(); // e.g. "articles/abc.jpg" on the public disk
            $table->string('image_alt')->nullable();

            // Relations
            $table->foreignId('category_id')
                ->constrained('categories')
                ->cascadeOnDelete();

            $table->foreignId('editor_id')
                ->constrained('editors')
                ->cascadeOnDelete();

            // Publishing / meta
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->boolean('featured')->default(false);
            $table->unsignedBigInteger('views')->default(0);
            $table->integer('duration_seconds')->default(0);     // reading time etc.
            $table->decimal('engagement_rate', 5, 2)->nullable(); // e.g. 87.32
            $table->timestamp('published_at')->nullable();

            // Housekeeping
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
