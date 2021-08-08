<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model {
	
	protected $table = 'order';

	static public function get_single($id)
	{
		return self::find($id);
	}

	public function getUserName(){
		return $this->belongsTo(User::class, "user_id");
	}

	public function getProductName(){
		return $this->belongsTo(ProductModel::class, "product_id");
	}
}
?>