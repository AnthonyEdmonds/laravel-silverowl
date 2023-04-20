<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('content_tag', function (Blueprint $table) {
            $table->unsignedInteger('content_id');
            $table->unsignedInteger('tag_id');

            $table->primary(['content_id', 'tag_id'], 'pk_content_tag');

            $table->foreign('content_id', 'fk_content_tag_content')
                ->references('id')
                ->on('content')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('tag_id', 'fk_content_tag_tag')
                ->references('id')
                ->on('tags')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('content_tag');
    }
};
