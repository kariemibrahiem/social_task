<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('comment_replies', function (Blueprint $table) {
            $table->id();

            $table->foreignId('comment_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // post owner

            $table->text('text');
            $table->timestamps();

            // reply واحد بس لكل comment
            $table->unique('comment_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comment_replies');
    }
};
