<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            // Threading (self-reference)
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('comments')
                ->cascadeOnDelete();

            // Relations
            $table->foreignId('article_id')
                ->constrained('articles')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Content
            $table->text('comment');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
