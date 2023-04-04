<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $table = 'clients';
	protected $fillable = ['valor'];
	protected $hidden = ['created_at', 'updated_at'];

	
}
