<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model {
	
	protected $table = 'product';

	static public function get_single($id)
	{
		return self::find($id);
	}

	public function getUserName(){
		return $this->belongsTo(User::class, "user_id");
	}

	
}
?>