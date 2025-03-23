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
        Schema::table('job_boards', function (Blueprint $table) {
            $table->index(['title', 'company_name', 'job_type', 'status']);
            $table->index(['salary_min', 'salary_max']);
            $table->index('published_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_boards', function (Blueprint $table) {
            $table->dropIndex('job_boards_title_company_type_status_index');
            $table->dropIndex('job_boards_salary_index');
            $table->dropIndex('job_boards_published_at_index');
        });
    }
};
