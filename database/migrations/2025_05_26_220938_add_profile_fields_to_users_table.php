<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->nullable();
            $table->date('birthday')->nullable();
            $table->string('profile_photo')->nullable();
            $table->text('about_me')->nullable();
            $table->string('location')->nullable();
            $table->string('website')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'username', 
                'birthday', 
                'profile_photo', 
                'about_me',
                'location',
                'website'
            ]);
        });
    }
};