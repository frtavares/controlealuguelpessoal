<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Mail\PendingMail;

class Rent extends Model
{
    use SoftDeletes;

    protected $dates    = ['deleted_at'];
    protected $table    = 'rents';
    protected $hidden   = ['created_at', 'updated_at'];



    public function clis(){

        return $this->hasMany(Client::class, 'id', 'client_id');
    }

  

    public function anoss(){

        return $this->hasOne(Ano::class, 'id', 'ano_id');


    }

    

    public function mesess(){

        return $this->hasOne(Mes::class, 'id', 'mes_id');
    }




    public function generate_unique_code($table = NULL, $type_of_code = NULL, $size_of_code, $field_search) {

        do {
            $code = random_string($type_of_code, $size_of_code);
            $this->db->where($field_search, $code);
            $this->db->from($table);
        } while ($this->db->count_all_results() >= 1);

        return $code;
    }


}
