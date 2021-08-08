<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HotelModel extends Model {
	
	protected $table = 'hotel';

	static public function get_single($id)
	{
		return self::find($id);
	}
	 public function getuserRestaurant() {
      return $this->hasMany(HotelFoodMenuModel::class, "hotel_id");
    }
}

?>