<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wallet_transactions extends Model
{
    use HasFactory;

   public function user(){
        return$this->belongsTo(User::class);
    }
}
