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
        Schema::create('bill_status', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status_name');
        });

       DB::table('bill_status')->insert([
           ['status_name' => 'فاتورة مدفوعة'] ,
           ['status_name' => 'فاتورة غير مدفوعة'] ,
           ['status_name' => ' فاتورة مدفوعة جزئيا']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_status');
    }
};
