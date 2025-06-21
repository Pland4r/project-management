<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('project_permissions', function (Blueprint $table) {
            $table->foreignId('essai_messure_id')->nullable()->constrained('essais_messures')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_permissions', function (Blueprint $table) {
            $table->dropForeign(['essai_messure_id']);
            $table->dropColumn('essai_messure_id');
        });
    }
};
