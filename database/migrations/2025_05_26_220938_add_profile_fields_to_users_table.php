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
        $table->string('username')->nullable();
        $table->date('birthday')->nullable();
        $table->text('about_me')->nullable();
        $table->string('profile_picture')->nullable(); // Pad naar afbeelding
    });
}


    /**
     * Reverse the migrations.
     */
   public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['username', 'birthday', 'about_me', 'profile_picture']);
    });
}
};
