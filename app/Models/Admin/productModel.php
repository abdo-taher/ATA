<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name', 'section_id', 'description', 'status', 'added_by', 'updated_by', 'deleted_at', 'created_at', 'updated_at'    ];
    protected $table = 'products';

    public function added(){
        return $this->belongsTo(\App\Models\Admin\adminModel::class,'added_by');
    }
    public function edit_by(){
        return $this->belongsTo(\App\Models\Admin\adminModel::class,'updated_by');
    }

    public function section() {
        return $this->belongsTo(\App\Models\Admin\sectionModel::class,'section_id');
    }

}
