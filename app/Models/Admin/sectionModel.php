<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sectionModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'section_name', 'description', 'status', 'added_by', 'updated_by', 'deleted_at', 'created_at', 'updated_at'
    ];
    protected $table = 'sections';

    public function added(){
        return $this->belongsTo(\App\Models\User::class,'added_by');
    }
    public function updated_by(){
        return $this->belongsTo(\App\Models\User::class,'updated_by');
    }
    public function status(){
        if ($this->status == 1){
            return 'مفعل';
        }if ($this->status == 2)
            return 'مؤرشف' ;
        else{
            return 'غير مفعل' ;
        }

    }
}
