<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tax_deduction_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('discount_rate');
            $table->tinyInteger('status')->default(1);
            $table->integer('added_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
        DB::table('tax_deduction_rates')->insert([
            ['discount_rate' => '5'] ,
            ['discount_rate' => '10'] ,
            ['discount_rate' => '15']

        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tax_deduction_rate');
    }
};
