<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WestwayFoodBestSellerModel extends Model {
	
	protected $table = 'westway_food_best_seller';

	static public function get_single($id)
	{
		return self::find($id);
	}
	
	public function getWestwayFoodMenuName(){
		return $this->belongsTo(FoodMenuModel::class, "westway_food_menu_id");
	}

}

?>