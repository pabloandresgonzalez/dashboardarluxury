<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetworkTransaction extends Model
{
    use HasFactory;

   //Relacion
   public function users(){
      return $this->belongsTo('App\User', 'id');
   }

   //Relacion
   public function usersownerId(){
      return $this->belongsTo('App\User', 'ownerId');
   }

   public function asuser(){
      return$this->belongsTo(User::class);
   }

   //Relacion
   public function UserMembership() {
        return $this->hasMany('App\UserMembership');
    }

    public function asUserMembership() {
        return $this->hasMany(UserMembership::class, 'user')->orderBy('id', 'desc');
    }
    
}
