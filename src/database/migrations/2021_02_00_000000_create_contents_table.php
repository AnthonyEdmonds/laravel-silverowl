<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->timestamps();

            $table->string('title')->unique('uq_content_title');
            $table->string('slug')->unique('uq_content_slug');
            $table->text('markdown');
            $table->unsignedInteger('views')->default(0);

            $table->unsignedInteger('author_id');
            $table->unsignedInteger('category_id');
            $table->string('index');

            $table->foreign('author_id', 'fk_contents_author')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreign('category_id', 'fk_contents_category')
                ->references('id')
                ->on('categories')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
