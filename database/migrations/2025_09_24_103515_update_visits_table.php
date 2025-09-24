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
        Schema::table('visits', function (Blueprint $table) {
            $table->dropForeign(['attendant']);
            $table->dropColumn('attendant');
            $table->string('employee_id')->after('visitor_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visits', function (Blueprint $table) {
            $table->foreignId('attendant')->nullable()->constrained('employees')->onDelete('set null');
            $table->dropColumn('employee_id');
        });
    }
};
