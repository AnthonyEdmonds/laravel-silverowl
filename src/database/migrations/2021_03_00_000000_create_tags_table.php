<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->timestamps();

            $table->string('label')->unique('uq_tag_label');
            $table->string('slug')->unique('uq_tag_slug');
            $table->string('colour');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
};
