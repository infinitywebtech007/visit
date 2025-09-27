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
        Schema::create('security_guards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('phone')->nullable();
            $table->string('company')->nullable(); // Security Company the guard is associated with
            $table->string('shift')->nullable(); // e.g., Day, Night
            $table->string('photo')->nullable(); // Path to the guard's photo
            $table->boolean('active')->default(1); // Additional notes about the guard
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('security_guards');
    }
};
