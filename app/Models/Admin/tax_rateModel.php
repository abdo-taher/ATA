<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tax_rateModel extends Model
{
    use HasFactory;
    protected $table = 'tax_deduction_rates';
    protected $guarded = [];

}
