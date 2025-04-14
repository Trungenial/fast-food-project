<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('birthdate')->nullable();
            $table->string('gender')->nullable(); 
            $table->string('province')->nullable();
            $table->boolean('agree_policy')->default(false);
            $table->boolean('receive_discount')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'birthdate',
                'gender',
                'province',
                'agree_policy',
                'receive_discount',
            ]);
        });
    }
};
