<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class UGallery extends Model
{
    use SoftDeletes;

    protected $dates    = ['deleted_at'];
    protected $table    = 'booking_gallery';
    protected $hidden   = ['created_at', 'updated_at'];

   


}
