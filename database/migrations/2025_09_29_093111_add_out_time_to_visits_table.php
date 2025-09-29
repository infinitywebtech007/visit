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
            $table->timestamp('out_time')->nullable()->after('created_at');
            $table->foreignId('security_guard_id')->nullable()->after('out_time')->constrained('security_guards')->onDelete('set null');
            $table->foreignId('closed_by')->nullable()->after('security_guard_id')->constrained('security_guards')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visits', function (Blueprint $table) {
            $table->dropForeign(['closed_by']);
            $table->dropColumn('closed_by');
            $table->dropForeign(['security_guard_id']);
            $table->dropColumn('security_guard_id');
            $table->dropColumn('out_time');
        });
    }
};
