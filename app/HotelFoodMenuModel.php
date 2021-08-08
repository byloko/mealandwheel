<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HotelFoodMenuModel extends Model {
	
	protected $table = 'hotel_food_menu';

	static public function get_single($id)
	{
		return self::find($id);
	}

	public function getTag() {
		return $this->belongsTo(FoodMenuModel::class, "food_menu_id");
	}
	
}
