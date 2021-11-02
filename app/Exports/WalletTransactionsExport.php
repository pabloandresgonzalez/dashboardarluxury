<?php

namespace App\Exports;

use App\Models\wallet_transactions;
use Maatwebsite\Excel\Concerns\FromCollection;

class WalletTransactionsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return wallet_transactions::all();
    }
}
