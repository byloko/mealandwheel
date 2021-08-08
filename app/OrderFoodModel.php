<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderFoodModel extends Model {
	
	protected $table = 'order_food';

	static public function get_single($id)
	{
		return self::find($id);
	}

	public function getHotelName()
	{
		return $this->belongsTo(HotelModel::class, "hotel_id");
	}

	public function getFoodMenuName()
	{
		return $this->belongsTo(FoodMenuModel::class, "food_menu_id");
	}
	
}

?>