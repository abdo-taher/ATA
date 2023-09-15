<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class bill_detailModel extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'bill_details';
    protected $fillable = ['bill_code', 'bill_id', 'section_id', 'product_id', 'status_id', 'payment_date', 'note', 'added_by', 'updated_by', 'deleted_at', 'created_at', 'updated_at'];

    public function added(){
        return $this->belongsTo(\App\Models\User::class,'added_by');
    }
    public function updatedd(){
        return $this->belongsTo(\App\Models\User::class,'updated_by');
    }
    public function section() {
        return $this->belongsTo(\App\Models\Admin\sectionModel::class,'section_id');
    }
    public function product() {
        return $this->belongsTo(\App\Models\Admin\productModel::class,'product_id');
    }
    public function status() {
        return $this->belongsTo(\App\Models\Admin\bill_statuModel::class,'status_id');
    }

    protected $dates =['deleted_at'];
}
