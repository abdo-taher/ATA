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
            $table->integer('added_by')->nullable()->unsigned();
            $table->integer('updated_by')->nullable()->unsigned();
            $table->foreign('added_by')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('admins')->onDelete('cascade');
            $table->integer('company_code');
            $table->string('company_alert')->nullable();
            $table->timestamps();
        });
        \Illuminate\Support\Facades\DB::table('general_settings')->insert([
            "company_name" => 'الوفاء جروب',
            "phones" => '000000000',
            "address" => 'القاهرة الجديدة',
            "email" => 'admin@admin',
            "added_by" => '1',
            "company_code" => 1,

        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_settings');
    }
};
