<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMembership extends Model
{
    use HasFactory;

    //Relacion
    public function users(){
       return $this->belongsTo('App\User', 'id');
    }

    public function user(){
       return$this->belongsTo(User::class);
    }
}
