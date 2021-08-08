<?php

namespace App\Http\Controllers\Backend;
use App\HotelModel;
use App\FoodMenuModel;
use App\HotelFoodMenuModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HotelController extends Controller
{

	public function hotel_index(Request $request)
	{
		$getrecord = HotelModel::orderBy('id', 'desc');
		//Search Box Start
		if(!empty($request->idsss)){
			$getrecord = $getrecord->where('hotel.id', '=', $request->idsss);
		}

		if(!empty($request->hotel_name)){
			$getrecord = $getrecord->where('hotel.hotel_name', 'like', '%' . $request->hotel_name . '%');
		}
		// Search Box End
		$getrecord = $getrecord->paginate(40);
		$data['getrecord'] = $getrecord;
		$data['meta_title'] = 'Hotel List';
		return view('backend.hotel.list', $data);
	}

	public function hotel_create(Request $request)
	{
		$data['getfoodmenu'] = FoodMenuModel::get(); 
		$data['meta_title'] = 'Add Hotel';

		return view('backend.hotel.add', $data);
	}

	public function hotel_store(Request $request)
	{
		$insert_record = new HotelModel;
		$insert_record->hotel_name = trim($request->hotel_name);
		if (!empty($request->file('hotel_image'))) {
            $ext = 'jpg';
            $file = $request->file('hotel_image');
            $randomStr = str_random(30);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/hotel/', $filename);
            $insert_record->hotel_image = $filename;
        }
        $insert_record->hotel_description = trim($request->hotel_description);
		$insert_record->save();

		HotelFoodMenuModel::where('hotel_id','=',$insert_record->id)->delete();

		if(!empty($request->food_menu_id)) {
            foreach ($request->food_menu_id as  $food_menu_id) {
                $res = new HotelFoodMenuModel;
                $res->hotel_id 			= $insert_record->id;
                $res->food_menu_id = $food_menu_id;
                $res->save();
            }    
        }


		return redirect('admin/hotel')->with('success', 'Record successfully create.');
	}

	public function hotel_edit($id){
		$data['getrecord'] = HotelModel::get_single($id);
		$data['getfoodmenu'] = FoodMenuModel::get(); 
		$data['getHotelFoodMenuOption'] = HotelFoodMenuModel::where('hotel_id','=',$id)->get();
		$data['meta_title'] = 'Edit Hotel';
		return view('backend.hotel.edit', $data);
	}

	public function hotel_update($id, Request $request){
		$update_record = HotelModel::get_single($id);
		$update_record->hotel_name = $request->hotel_name;
		if (!empty($request->file('hotel_image')))
        {
            if (!empty($update_record->hotel_image) && file_exists('upload/hotel/'.$update_record->hotel_image))
            {
                unlink('upload/hotel/'.$update_record->hotel_image);
            }
            $ext = 'jpg';
            $file = $request->file('hotel_image');
            $randomStr = str_random(30);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/hotel/', $filename);
            $update_record->hotel_image = $filename;
        }
        $update_record->hotel_description = $request->hotel_description;
        $update_record->save();

        HotelFoodMenuModel::where('hotel_id','=',$update_record->id)->delete();

		if(!empty($request->food_menu_id)) {
            foreach ($request->food_menu_id as  $food_menu_id) {
                $res = new HotelFoodMenuModel;
                $res->hotel_id 			= $update_record->id;
                $res->food_menu_id = $food_menu_id;
                $res->save();
            }    
        }


        return redirect('admin/hotel')->with('success', 'Record successfully register.');

	}

	public function hotel_destroy($id){
		$delete_best = HotelModel::get_single($id);
        $delete_best->delete();
        return redirect()->back()->with('error', 'Record successfully deleted!');
	}


}

?>