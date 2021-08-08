<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodSubMenuModel extends Model {
	
	protected $table = 'food_sub_menu';

	static public function get_single($id)
	{
		return self::find($id);
	}

	public function getFoodMenuName() {
		return $this->belongsTo(FoodMenuModel::class, "food_menu_id");
	}
	
	public function getHotelName() {
		return $this->belongsTo(HotelModel::class, "hotel_id");
	}
} 

?>