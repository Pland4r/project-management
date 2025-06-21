<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('gamme_files', function (Blueprint $table) {
        $table->id();
        $table->foreignId('gamme_id')->constrained();
        $table->string('file_name');
        $table->string('file_path');
        $table->string('original_name');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gamme_files');
    }
};
