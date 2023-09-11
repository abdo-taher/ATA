<?php

namespace App\Exports\Admin;

use App\Models\Admin\billModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class billExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return billModel::all();
    }
}
