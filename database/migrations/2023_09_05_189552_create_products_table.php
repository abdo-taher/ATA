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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_name',225);
            $table->integer('section_id')->unsigned();
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('added_by');
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        \Illuminate\Support\Facades\DB::table('products')->insert([
            [
                'product_name'=>'قروض البك الاهلي',
                'description'=>'متخصص في سرقة الاموال من الناس المغفلة',
                'section_id'=>'1',
                'added_by'=>'1',
            ],[
                'product_name'=>'ودائع البنك الاهلي',
                'description'=>'متخصص في سرقة الاموال من الناس المغفلة',
                'section_id'=>'1',
                'added_by'=>'1',
            ],[
                'product_name'=>'قروض بنك مصر',
                'description'=>'متخصص في سرقة الاموال من الناس المغفلة',
                'section_id'=>'2',
                'added_by'=>'1',
            ],[
                'product_name'=>'ودائع بنك مصر',
                'description'=>'متخصص في سرقة الاموال من الناس المغفلة',
                'section_id'=>'2',
                'added_by'=>'1',
            ],[
                'product_name'=>'قروض بنك الرجحي',
                'description'=>'متخصص في حفظ الاموال من الناس المغفلة',
                'section_id'=>'3',
                'added_by'=>'1',
            ],[
                'product_name'=>'ودائع بنك الرجحي',
                'description'=>'متخصص في حفظ الاموال من الناس المغفلة',
                'section_id'=>'3',
                'added_by'=>'1',
            ],[
                'product_name'=>'قروض CIB',
                'description'=>'متخصص في سرقة الاموال من الناس المغفلة',
                'section_id'=>'4',
                'added_by'=>'1',
            ],[
                'product_name'=>'ودائع CIB',
                'description'=>'متخصص في سرقة الاموال من الناس المغفلة',
                'section_id'=>'4',
                'added_by'=>'1',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
