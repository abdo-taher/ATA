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
        Schema::create('general_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name',250);
            $table->tinyInteger('system_status')->default('1')->comment('واحد مفعل - صفر معطل');
            $table->string('image',250)->nullable();
            $table->string('phones',250);
            $table->string('address',250);
            $table->string('email',100);
            $table->integer('company_code');
            $table->string('company_alert')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_settings');
    }
};
