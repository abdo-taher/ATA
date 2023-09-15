<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class billModel extends Model

{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'bill_code', 'bill_date', 'due_date',  'section_id', 'product_id', 'mount_collection', 'mount_commission', 'discount', 'value_vat', 'discount_rate_id ', 'total', 'status_id', 'note', 'payment_date', 'added_by', 'updated_by', 'deleted_at', 'created_at', 'updated_at'
    ];
    protected $table = 'bills';

    public function added(){
        return $this->belongsTo(\App\Models\User::class,'added_by');
    }
    public function updated_by(){
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
    public function discount_rate() {
        return $this->belongsTo(\App\Models\Admin\tax_rateModel::class,'discount_rate_id');
    }

    protected $dates =['deleted_at'];
}
