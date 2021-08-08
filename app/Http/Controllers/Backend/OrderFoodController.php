<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\OrderFoodModel;
use App\HotelModel;
use App\FoodMenuModel;

class OrderFoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function order_food_index(Request $request)
    {
        $getrecord = OrderFoodModel::orderBy('id', 'desc')->select('order_food.*');
        $getrecord = $getrecord->join('hotel', 'order_food.hotel_id', '=', 'hotel.id'); 
        $getrecord = $getrecord->join('food_menu', 'order_food.food_menu_id', '=', 'food_menu.id'); 
        //Search Box Start
        if(!empty($request->idsss)){
            $getrecord = $getrecord->where('order_food.id', '=', $request->idsss);
        }

        if(!empty($request->hotel_id)){
            $getrecord = $getrecord->where('hotel.hotel_name', 'like', '%' .$request->hotel_id. '%');
        }

        if(!empty($request->food_menu_id)){
            $getrecord = $getrecord->where('food_menu.food_menu_name', 'like', '%' .$request->food_menu_id. '%');
        }

        if(!empty($request->order_food_name)){
            $getrecord = $getrecord->where('order_food.order_food_name', 'like', '%' .$request->order_food_name. '%');
        }

        
        //Search Box End
        $getrecord = $getrecord->paginate(40);
        $data['getrecord'] = $getrecord;
        $data['meta_title'] = 'Order Food List';
        return view('backend.order_food.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function order_food_create()
    {
        $data['getfoodmenu'] = FoodMenuModel::get(); 
        $data['gethotel']   = HotelModel::get();
        $data['meta_title'] = 'Add Order Food';
        return view('backend.order_food.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function order_food_store(Request $request)
    {
        //dd($request->all());
        $insert_record = new OrderFoodModel;
        $insert_record->hotel_id            = trim($request->hotel_id);
        $insert_record->food_menu_id        = trim($request->food_menu_id);
        
        // if (!empty($request->file('order_food_image'))) {
        //     $ext = 'jpg';
        //     $file = $request->file('order_food_image');
        //     $randomStr = str_random(30);
        //     $filename = strtolower($randomStr) . '.' . $ext;
        //     $file->move('upload/food/', $filename);
        //     $insert_record->order_food_image = $filename;
        // }

        
        $insert_record->order_food_name     = trim($request->order_food_name);
        $insert_record->order_category_name = trim($request->order_category_name);
        $insert_record->price               = trim($request->price);
        $insert_record->save();
        return redirect('admin/order_food')->with('success', 'Record successfully create.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function order_food_show($id)
    {
        $data['getrecord'] = OrderFoodModel::get_single($id);
        $data['meta_title'] = 'View Order Food';
        return view('backend.order_food.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function order_food_edit($id)
    {
        $data['getrecord']   = OrderFoodModel::get_single($id);
        $data['getfoodmenu'] = FoodMenuModel::get(); 
        $data['gethotel']    = HotelModel::get();
        $data['meta_title']  = 'Edit Order Food';
        return view('backend.order_food.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function order_food_update(Request $request, $id)
    {
        $update_record                  = OrderFoodModel::get_single($id);
        $update_record->hotel_id        = $request->hotel_id;
        $update_record->food_menu_id    = $request->food_menu_id;

        // if (!empty($request->file('order_food_image')))
        // {
        //     if (!empty($update_record->order_food_image) && file_exists('upload/food/'.$update_record->order_food_image))
        //     {
        //         unlink('upload/food/'.$update_record->order_food_image);
        //     }
        //     $ext = 'jpg';
        //     $file = $request->file('order_food_image');
        //     $randomStr = str_random(30);
        //     $filename = strtolower($randomStr) . '.' . $ext;
        //     $file->move('upload/food/', $filename);
        //     $update_record->order_food_image = $filename;
        // }

        $update_record->price               = $request->price;
        $update_record->order_category_name = $request->order_category_name;
        $update_record->order_food_name     = $request->order_food_name;
        $update_record->save();
        return redirect('admin/order_food')->with('success', 'Record successfully register.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function order_food_destroy($id)
    {
        $delete_record = OrderFoodModel::get_single($id);
        $delete_record->delete();
        return redirect()->back()->with('error', 'Record successfully deleted!');
    }
}
