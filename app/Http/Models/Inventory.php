<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Inventory extends Model
{
    use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $table = 'product_inventory';
	protected $hidden = ['created_at', 'updated_at'];

	public function getProduct(){
		return $this->hasOne(Product::class, 'id', 'product_id');
	}
}
