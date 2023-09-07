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
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bill_code', 50);
            $table->date('bill_date')->nullable();
            $table->date('due_date')->nullable();
            $table->integer( 'section_id' )->unsigned();
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->integer( 'product_id' )->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->decimal('mount_collection',8,2)->nullable();;
            $table->decimal('mount_commission',8,2);
            $table->decimal('discount',8,2);
            $table->decimal('value_vat',8,2);
            $table->integer('discount_rate_id')->unsigned();
            $table->foreign('discount_rate_id')->references('id')->on('tax_deduction_rates')->onDelete('cascade');
            $table->decimal('total',8,2);
            $table->integer('status_id')->unsigned()->default(2);
            $table->foreign('status_id')->references('id')->on('bill_status')->onDelete('cascade');
            $table->text('note')->nullable();
            $table->date('payment_date')->nullable();
            $table->integer('added_by');
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
