<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\FoodSubMenuModel;
use App\FoodMenuModel;
use App\HotelModel;

class FoodSubMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function food_sub_menu_index(Request $request)
    {
        $getrecord = FoodSubMenuModel::orderBy('id', 'desc')->select('food_sub_menu.*');
        $getrecord = $getrecord->join('food_menu', 'food_sub_menu.food_menu_id', '=', 'food_menu.id');
        $getrecord = $getrecord->join('hotel', 'food_sub_menu.hotel_id', '=', 'hotel.id');
        // Search Box Start
        if(!empty($request->idsss)){
            $getrecord = $getrecord->where('food_sub_menu.id', '=', $request->idsss);
        }
        if(!empty($request->hotel_id)){
            $getrecord = $getrecord->where('hotel.hotel_name', 'like', '%' . $request->hotel_id . '%');
        }
        if(!empty($request->food_menu_id)){
            $getrecord = $getrecord->where('food_menu.food_menu_name', 'like', '%' . $request->food_menu_id . '%');
        }

        if(!empty($request->food_sub_menu_name)){
            $getrecord = $getrecord->where('food_sub_menu.food_sub_menu_name', 'like', '%' .$request->food_sub_menu_name. '%');
        }
        // Search Box End
        $getrecord = $getrecord->paginate(40);
        $data['getrecord'] = $getrecord;     
        $data['meta_title'] = 'Food Sub Menu List';
        return view('backend.food_sub_menu.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function food_sub_menu_create()
    {
        $data['getRecordHotelName']    = HotelModel::get();
        $data['getRecordFoodMenuName'] = FoodMenuModel::get();
        $data['meta_title'] = 'Add Food Sub Menu';
        return view('backend.food_sub_menu.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function food_sub_menu_store(Request $request)
    {
        //dd($request->all());
        $insert_record = new FoodSubMenuModel;
        $insert_record->hotel_id = trim($request->hotel_id);
        $insert_record->food_menu_id = trim($request->food_menu_id);
       
        if (!empty($request->file('food_image'))) {
            $ext = 'jpg';
            $file = $request->file('food_image');
            $randomStr = str_random(30);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/food/', $filename);
            $insert_record->food_image = $filename;
        }

        $insert_record->food_sub_menu_name = trim($request->food_sub_menu_name);
        $insert_record->save();
        return redirect('admin/food_sub_menu')->with('success', "Record successfully register.");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function food_sub_menu_edit($id)
    {
         $data['getRecordHotelName']    = HotelModel::get();
        $data['getRecordFoodMenuName'] = FoodMenuModel::get();
        $data['getrecord'] = FoodSubMenuModel::get_single($id);
        $data['meta_title'] = 'Edit Food Sub Menu';
        return view('backend.food_sub_menu.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function food_sub_menu_update(Request $request, $id)
    {
        //dd($request->all());
        $update = FoodSubMenuModel::get_single($id);
        $update->food_menu_id = $request->food_menu_id;
        $update->hotel_id = $request->hotel_id;

        if (!empty($request->file('food_image')))
        {
            if (!empty($update->food_image) && file_exists('upload/food/'.$update->food_image))
            {
                unlink('upload/food/'.$update->food_image);
            }
            $ext = 'jpg';
            $file = $request->file('food_image');
            $randomStr = str_random(30);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/food/', $filename);
            $update->food_image = $filename;
        }

        $update->food_sub_menu_name = $request->food_sub_menu_name;
        $update->save();
        return redirect('admin/food_sub_menu')->with('success', "Record successfully register.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function food_sub_menu_destroy($id)
    {
        $dele = FoodSubMenuModel::get_single($id);
        $dele->delete();
        return redirect()->back()->with('error', "Record successfully deleted!");
    }
}
