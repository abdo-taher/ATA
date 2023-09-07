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
        Schema::create('departments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',225)->unique();
            $table->string('phone',20);
            $table->text('notes')->nullable();
            $table->integer('added_by');
            $table->integer('updated_by')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->integer('com_code');
            $table->timestamps();
        });
        \Illuminate\Support\Facades\DB::table('departments')->insert([
            [
                'name' => 'الادارة',
                'phone' => '1',
                'active' => '1',
                'added_by' => '1',
                'com_code' => '1',
            ]
            ,[
                'name' => 'الحسابات',
                'phone' => '1',
                'active' => '1',
                'added_by' => '1',
                'com_code' => '1',
            ] ,
            [
                'name' => 'شئون العاملين',
                'phone' => '1',
                'active' => '1',
                'added_by' => '1',
                'com_code' => '1',
            ] ,[
                'name' => 'المبيعات',
                'phone' => '1',
                'active' => '1',
                'added_by' => '1',
                'com_code' => '1',
            ],


        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
