<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'cnpj'];

    protected $dates    = ['deleted_at'];
    protected $table    = 'bookings';
    protected $hidden   = ['created_at', 'updated_at'];


    public function clis(){

        return $this->hasOne(Client::class, 'id', 'client_id');

    }

    public function ships(){

        return $this->hasOne(Ship::class, 'id', 'ship_id');
    }

    public function getGallery(){

        return $this->hasMany(UGallery::class, 'booking_id', 'id');

    }

    public function model(array $row)
    {
        return new Booking([
           'status' => $row[1],
           'entrada' => $row[2],
           'codigo ' => $row[3],
           'container ' => $row[4]
        ]);
    }

}
