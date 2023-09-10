<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bill_attachmentModel extends Model
{
    use HasFactory;
    protected $table = 'bill_attachments';
    protected $guarded = [];
    public function added(){
        return $this->belongsTo(\App\Models\Admin\adminModel::class,'added_by');
    }
    public function updated_by(){
        return $this->belongsTo(\App\Models\Admin\adminModel::class,'updated_by');
    }
}
