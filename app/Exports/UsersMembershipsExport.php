<?php

namespace App\Exports;

use App\Models\UserMembership;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersMembershipsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return UserMembership::all();
    }
}
