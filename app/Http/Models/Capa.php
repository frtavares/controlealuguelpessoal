<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Capa extends Model
{
    use SoftDeletes;

    protected $dates    = ['deleted_at'];
    protected $table    = 'capas';
    protected $hidden   = ['created_at', 'updated_at'];



    public function clis(){

        return $this->hasOne(Client::class, 'id', 'client_id');
    }

    //  public function books(){

    //      return $this->hasOne(Booking::class, 'id', 'booking_id');
    // }

   public function trans(){

        return $this->hasOne(Transportadora::class, 'id', 'transportadora_id');
   }

   public function isoss(){

        return $this->hasOne(Iso::class, 'id', 'iso_id');
   }

   public function pess(){

        return $this->hasOne(Pessoa::class, 'id', 'pessoa_id');
   }

    public function ships(){

        return $this->hasOne(Ship::class, 'id', 'ship_id');

    }
}
