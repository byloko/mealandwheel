<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodMenuModel extends Model {
	
	protected $table = 'food_menu';

	static public function get_single($id)
	{
		return self::find($id);
	}
	
}
