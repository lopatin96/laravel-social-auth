<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('social_accounts', static function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->foreignId('user_id');
            $table->string('social_provider');
            $table->string('social_provider_user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('social_accounts');
    }
};
