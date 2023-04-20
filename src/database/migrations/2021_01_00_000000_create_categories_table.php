<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->timestamps();

            $table->string('name')->unique('uq_category_name');
            $table->string('slug')->unique('uq_category_slug');
            $table->text('description');

            $table->unsignedInteger('parent_id')->nullable();
            $table->string('index');

            $table->foreign('parent_id')
                ->references('id')
                ->on('categories')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
