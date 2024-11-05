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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Auto increment primary key
            $table->string('nip_nim_nidn', 15)->unique(); // Field for NIP, NIM, or NIDN with max length 15
            $table->string('name', 255); // Name of user
            $table->string('email', 255)->unique(); // Email must be unique
            $table->timestamp('email_verified_at')->nullable(); // Nullable email verification timestamp
            $table->string('password', 255); // Password field
            $table->tinyInteger('role')->default(0); // Role with default value 0 (0:Pustakawan, 1:Member)
            $table->string('no_hp', 20)->nullable(); // Nullable phone number with max length 20
            $table->string('foto', 255)->nullable(); // Nullable photo field
            $table->rememberToken(); // For "remember me" functionality
            $table->timestamps(); // created_at and updated_at timestamps
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
