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

   public function asuser(){
      return $this->belongsTo(User::class);
   }

   //Relacion
   public function membresias(){
      return $this->belongsTo('App\Membresia', 'id');
   }

   public function amembresia(){
      return $this->belongsTo(Membresia::class);
   }

}
