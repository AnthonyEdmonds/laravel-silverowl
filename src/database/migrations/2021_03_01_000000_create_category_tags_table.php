<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('category_tag', function (Blueprint $table) {
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('tag_id');

            $table->primary(['category_id', 'tag_id'], 'pk_category_tag');

            $table->foreign('category_id', 'fk_category_tag_category')
                ->references('id')
                ->on('categories')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('tag_id', 'fk_category_tag_tag')
                ->references('id')
                ->on('tags')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_tag');
    }
};
