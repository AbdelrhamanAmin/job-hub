<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('job_attribute_values', function (Blueprint $table) {
            $table->index(['job_board_id', 'attribute_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_attribute_values', function (Blueprint $table) {
            $table->dropIndex('job_attribute_values_job_attribute_index');
        });
    }
};
