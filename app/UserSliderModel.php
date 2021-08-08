<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSliderModel extends Model {
	
	protected $table = 'user_slider';

	static public function get_single($id)
	{
		return self::find($id);
	}
}

?>