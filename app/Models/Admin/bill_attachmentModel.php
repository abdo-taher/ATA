<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bill_attachmentModel extends Model
{
    use HasFactory;
    protected $table = 'bill_attachments';
    protected $guarded = [];
}
