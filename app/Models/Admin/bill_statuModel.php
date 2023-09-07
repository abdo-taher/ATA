<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bill_statuModel extends Model
{
    use HasFactory;
    protected $table = 'bill_status';
    protected $guarded = [];
}
