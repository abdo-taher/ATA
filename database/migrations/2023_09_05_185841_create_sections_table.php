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
        Schema::create('sections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('section_name',225);
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('added_by');
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        \Illuminate\Support\Facades\DB::table('sections')->insert([
            [
                'section_name'=>'البنك الاهلي المصري',
                'description'=>'متخصص في سرقة الاموال من الناس المغفلة',
                'added_by'=>'1',
            ],[
                'section_name'=>'بنك مصر',
                'description'=>'متخصص في النصب علي المحتالين',
                'added_by'=>'1',
            ],[
                'section_name'=>'بنك الراجحي',
                'description'=>'حلو شوية عن الي فاتو',
                'added_by'=>'1',
            ],[
                'section_name'=>'بنك CIB',
                'description'=>'متخصص في النصب علي الناس الهاي',
                'added_by'=>'1',
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
