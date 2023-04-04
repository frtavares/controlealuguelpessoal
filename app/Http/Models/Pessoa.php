<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Models\Occupation;

class Pessoa extends Model
{
    use SoftDeletes;

    protected $dates    = ['deleted_at'];
    protected $table    = 'pessoas';
    protected $hidden   = ['created_at', 'updated_at'];

    public function occs(){

        return $this->hasOne(Occupation::class, 'id', 'occupation_id');

    }

    
}
