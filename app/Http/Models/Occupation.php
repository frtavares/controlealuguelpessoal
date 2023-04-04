<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Occupation extends Model
{
    use SoftDeletes;

    protected $dates    = ['deleted_at'];
    protected $table    = 'occupations';
    protected $hidden   = ['created_at', 'updated_at'];
}
