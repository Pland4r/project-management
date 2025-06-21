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
    Schema::create('projects', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained();
        $table->enum('type', ['essai', 'messure']);
        $table->string('project_name');
        $table->string('essai_messure_name');
        $table->string('person_name');
        $table->string('validator_name');
        $table->date('start_date');
        $table->date('end_date');
        $table->string('etat');
        $table->text('commentaire');
        $table->string('reference');
        $table->string('name');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
