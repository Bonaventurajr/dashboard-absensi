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
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kolom role dengan default 'user'
            $table->string('role')->default('user')->after('password');
            
            // Tambahkan kolom is_active dengan default true
            $table->boolean('is_active')->default(true)->after('role');
            
            // Tambahkan kolom photo (opsional)
            $table->string('photo')->nullable()->after('is_active');
            
            // Tambahkan kolom phone (opsional)
            $table->string('phone')->nullable()->after('photo');
            
            // Tambahkan kolom last_login_at
            $table->timestamp('last_login_at')->nullable()->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'is_active', 'photo', 'phone', 'last_login_at']);
        });
    }
};